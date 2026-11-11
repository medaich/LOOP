import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useParams, useNavigate, Link } from 'react-router-dom';

const QuizGame = ({ forcedId }) => {
    const { id: paramId } = useParams();
    const id = paramId || forcedId;
    const navigate = useNavigate();
    const [quiz, setQuiz] = useState(null);
    const [currentQuestionIndex, setCurrentQuestionIndex] = useState(0);
    const [answers, setAnswers] = useState({});
    const [loading, setLoading] = useState(true);
    const [result, setResult] = useState(null);
    const [startTime, setStartTime] = useState(null);

    useEffect(() => {
        const fetchQuiz = async () => {
            try {
                const response = await axios.get(`/api/v1/quizzes/${id}`);
                setQuiz(response.data);
                setStartTime(new Date());
                setLoading(false);
            } catch (error) {
                console.error("Error fetching quiz:", error);
                setLoading(false);
            }
        };
        fetchQuiz();
    }, [id]);

    const handleAnswerSelect = (questionId, optionText) => {
        setAnswers(prev => ({ ...prev, [questionId]: optionText }));
    };

    const handleNext = () => {
        if (quiz?.questions && currentQuestionIndex < quiz.questions.length - 1) {
            setCurrentQuestionIndex(prev => prev + 1);
        } else {
            handleSubmit();
        }
    };

    const handleSubmit = async () => {
        setLoading(true);
        try {
            const response = await axios.post(`/api/v1/quizzes/${id}/submit`, {
                answers: answers
            });
            setResult(response.data.data);
        } catch (error) {
            console.error("Quiz submission failed:", error);
        } finally {
            setLoading(false);
        }
    };

    if (result) {
        const passed = result.passed;
        return (
            <div className="min-h-screen bg-[#0F172A] flex items-center justify-center p-4">
                <div className="bg-[#1E293B] p-12 rounded-[3.5rem] border border-white/5 shadow-3xl text-center max-w-lg relative overflow-hidden">
                    <div className={`absolute top-0 left-0 w-full h-2 ${passed ? 'bg-emerald-500' : 'bg-red-500'}`} />
                    <div className="text-8xl mb-6">{passed ? '🎖️' : '📚'}</div>
                    <h2 className="text-4xl font-black text-white mb-2 italic tracking-tight">{passed ? 'QUALIFIED!' : 'RETRY ADVISED'}</h2>
                    <p className="text-slate-400 mb-8 font-medium leading-relaxed">
                        {passed
                            ? `Exceptional work! You've mastered this module with a score of ${result.score}% and earned ${result.xp_earned} XP.`
                            : `You scored ${result.score}%. A minimum of ${quiz?.passing_score}% is required to earn XP and progress.`}
                    </p>

                    <button
                        onClick={() => navigate('/')}
                        className="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-black py-5 rounded-2xl transition-all shadow-xl shadow-indigo-500/20"
                    >
                        RETURN TO DASHBOARD
                    </button>
                    {!passed && (
                        <button
                            onClick={() => window.location.reload()}
                            className="w-full mt-4 bg-slate-800 text-slate-400 font-black py-4 rounded-2xl hover:text-white transition-all"
                        >
                            RETRY MODULE
                        </button>
                    )}
                </div>
            </div>
        );
    }

    const currentQuestion = quiz?.questions?.[currentQuestionIndex];
    if (loading && !quiz) {
        return (
            <div className="flex items-center justify-center min-h-screen bg-[#0F172A] text-white">
                <div className="w-16 h-16 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
            </div>
        );
    }

    if (!quiz || !currentQuestion) {
        return (
            <div className="flex items-center justify-center min-h-screen bg-[#0F172A] text-white">
                <div className="text-center">
                    <p className="text-slate-400 font-bold mb-4">Exercise content is being prepared...</p>
                    <Link to="/" className="text-indigo-400 font-black uppercase tracking-widest text-xs">Return to Dashboard</Link>
                </div>
            </div>
        );
    }

    const progress = ((currentQuestionIndex + 1) / quiz.questions.length) * 100;

    return (
        <div className="min-h-screen bg-[#0F172A] text-slate-200 p-4 md:p-8 font-sans">
            <div className="max-w-4xl mx-auto space-y-12">
                <div className="flex items-center justify-between">
                    <div className="flex items-center gap-4">
                        <div className="w-12 h-12 rounded-2xl bg-indigo-500/10 flex items-center justify-center text-2xl border border-indigo-500/20">
                            🧠
                        </div>
                        <div>
                            <h1 className="text-2xl font-black text-white tracking-tight leading-none uppercase italic">{quiz?.title}</h1>
                            <span className="text-[10px] font-black text-slate-500 uppercase tracking-widest">Question {currentQuestionIndex + 1} of {quiz?.questions.length}</span>
                        </div>
                    </div>
                    <div className="hidden md:flex flex-col items-end">
                        <span className="text-[10px] font-black text-emerald-400 uppercase tracking-widest mb-1">Target: {quiz?.passing_score}%</span>
                        <div className="w-32 h-1.5 bg-slate-800 rounded-full overflow-hidden">
                            <div className="h-full bg-emerald-500 rounded-full" style={{ width: `${quiz?.passing_score}%` }}></div>
                        </div>
                    </div>
                </div>

                <div className="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden mb-12">
                    <div
                        className="h-full bg-gradient-to-r from-indigo-500 to-purple-500 transition-all duration-500"
                        style={{ width: `${progress}%` }}
                    ></div>
                </div>

                <div className="bg-[#1E293B] rounded-[3rem] p-10 md:p-14 border border-white/5 shadow-3xl relative overflow-hidden group">
                    <div className="absolute top-0 right-0 p-10 text-[12rem] opacity-[0.02] pointer-events-none select-none group-hover:rotate-12 transition-transform duration-1000">
                        ⚡
                    </div>

                    <h3 className="text-2xl md:text-3xl font-extrabold text-white mb-12 leading-snug max-w-2xl relative z-10">
                        {currentQuestion?.question_text}
                    </h3>

                    <div className="space-y-4 relative z-10">
                        {currentQuestion?.options.map((option, index) => (
                            <button
                                key={index}
                                onClick={() => handleAnswerSelect(currentQuestion.id, option)}
                                className={`w-full text-left p-6 rounded-2xl border-2 transition-all flex items-center gap-6 group/option ${answers[currentQuestion.id] === option
                                    ? 'bg-indigo-600/20 border-indigo-500 text-white shadow-lg shadow-indigo-500/10'
                                    : 'bg-slate-800/40 border-white/5 text-slate-400 hover:border-white/10 hover:bg-slate-800/60'
                                    }`}
                            >
                                <span className={`w-10 h-10 rounded-xl flex items-center justify-center font-black text-sm transition-all ${answers[currentQuestion.id] === option ? 'bg-indigo-500 text-white' : 'bg-slate-700 text-slate-400 group-hover/option:bg-slate-600'
                                    }`}>
                                    {String.fromCharCode(65 + index)}
                                </span>
                                <span className="text-lg font-bold">{option}</span>
                            </button>
                        ))}
                    </div>

                    <div className="mt-12 flex justify-end relative z-10">
                        <button
                            onClick={handleNext}
                            disabled={answers[currentQuestion?.id] === undefined || loading}
                            className="bg-white text-slate-900 px-10 py-5 rounded-2xl font-black uppercase tracking-widest hover:scale-[1.05] active:scale-95 transition-all shadow-2xl shadow-white/10 disabled:opacity-30 flex items-center gap-3"
                        >
                            {currentQuestionIndex === quiz?.questions.length - 1 ? 'FINALIZE ASSESSMENT' : 'NEXT CHALLENGE'}
                            <span className="text-xl">➔</span>
                        </button>
                    </div>
                </div>

                <div className="text-center">
                    <p className="text-slate-600 text-xs font-black uppercase tracking-[0.3em] italic">
                        Accuracy is the key to mastering the loop.
                    </p>
                </div>
            </div>
        </div>
    );
};

export default QuizGame;
