import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useParams, useNavigate, Link } from 'react-router-dom';

const EmailPro = ({ forcedId }) => {
    const { id: paramId } = useParams();
    const id = paramId || forcedId;
    const navigate = useNavigate();
    const [exercise, setExercise] = useState(null);
    const [body, setBody] = useState('');
    const [subject, setSubject] = useState('');
    const [result, setResult] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchExercise = async () => {
            try {
                const response = await axios.get(`/api/v1/quizzes/${id}`);
                setExercise(response.data);
                setLoading(false);
            } catch (error) {
                console.error("Error fetching exercise:", error);
                setLoading(false);
            }
        };
        fetchExercise();
    }, [id]);

    const handleSubmit = async () => {
        setLoading(true);
        try {
            const response = await axios.post(`/api/v1/exercises/${id}/email/submit`, {
                scenario: exercise.metadata?.scenario || "General Professional Inquiry",
                subject_line: subject || "Enquiry regarding collaboration",
                body: body
            });
            setResult(response.data.data);
        } catch (error) {
            console.error("Submission failed:", error);
        } finally {
            setLoading(false);
        }
    };

    if (loading && !exercise) {
        return (
            <div className="flex items-center justify-center min-h-screen bg-[#0F172A] text-white">
                <div className="w-12 h-12 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
            </div>
        );
    }

    if (result) {
        return (
            <div className="min-h-screen bg-[#0F172A] flex items-center justify-center p-4">
                <div className="bg-[#1E293B] p-10 rounded-[2.5rem] border border-white/5 shadow-2xl max-w-2xl w-full relative overflow-hidden">
                    <div className="absolute top-0 right-0 p-10 text-[15rem] opacity-[0.02] pointer-events-none select-none">
                        ✉️
                    </div>
                    <div className="flex flex-col items-center text-center">
                        <div className="text-7xl mb-6">👔</div>
                        <h2 className="text-3xl font-black text-white mb-2">Editor's Feedback</h2>
                        <div className="text-7xl font-black text-indigo-400 mb-6">{result.score}%</div>

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4 w-full mb-8">
                            <div className="bg-slate-800/50 p-6 rounded-2xl border border-white/5 text-left">
                                <h4 className="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-4">Detailed Points</h4>
                                <ul className="space-y-3">
                                    {result.feedback?.map((f, i) => (
                                        <li key={i} className="text-sm text-slate-300 flex gap-3">
                                            <span className="text-indigo-400 font-bold">•</span> {f}
                                        </li>
                                    ))}
                                </ul>
                            </div>
                            <div className="bg-emerald-500/10 p-6 rounded-2xl border border-emerald-500/20 text-center flex flex-col justify-center">
                                <p className="text-xs font-black text-emerald-400 uppercase tracking-widest mb-2">Recognition</p>
                                <span className="text-3xl font-black text-emerald-400">+{result.xp_earned} XP</span>
                                <p className="text-[10px] text-emerald-500/60 font-bold mt-2">Level Up Progress Boosted</p>
                            </div>
                        </div>

                        <button
                            onClick={() => navigate('/')}
                            className="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-black py-4 rounded-2xl transition-all shadow-lg"
                        >
                            RETURN TO DASHBOARD
                        </button>
                    </div>
                </div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-[#0F172A] text-slate-200 p-4 md:p-8 font-sans">
            <div className="max-w-5xl mx-auto space-y-8">
                <div className="flex items-center justify-between">
                    <Link to="/" className="text-slate-500 hover:text-white transition-colors font-bold">← EXIT EDITOR</Link>
                    <div className="flex gap-4">
                        <div className="text-right">
                            <p className="text-[10px] font-black text-slate-500 uppercase tracking-widest">Target Scenario</p>
                            <p className="text-sm font-bold text-indigo-400">{exercise?.metadata?.scenario}</p>
                        </div>
                    </div>
                </div>

                <div className="bg-[#1E293B] rounded-[3rem] border border-white/5 shadow-3xl overflow-hidden flex flex-col md:flex-row">
                    <div className="md:w-1/3 p-8 bg-slate-800/30 border-r border-white/5 flex flex-col justify-between">
                        <div>
                            <h1 className="text-3xl font-black text-white mb-6 tracking-tight">{exercise?.title}</h1>
                            <div className="space-y-6">
                                <div>
                                    <h4 className="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Instructions</h4>
                                    <p className="text-sm text-slate-400 leading-relaxed font-medium">
                                        {exercise?.description}
                                    </p>
                                </div>
                                <div className="p-5 bg-indigo-500/5 rounded-2xl border border-indigo-500/10">
                                    <h4 className="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-2">Tone Guidance</h4>
                                    <p className="text-xs text-indigo-300/80 leading-relaxed font-bold italic">
                                        Focus on professional courtesy, clear structure (Introduction, Body, Conclusion), and a direct call to action.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div className="mt-8 pt-6 border-t border-white/5">
                            <div className="flex items-center gap-3">
                                <div className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse" />
                                <span className="text-[10px] font-black text-slate-500 uppercase tracking-widest">Live Scoring System Ready</span>
                            </div>
                        </div>
                    </div>

                    <div className="flex-1 p-8 space-y-6">
                        <div className="space-y-4">
                            <div className="flex flex-col gap-1">
                                <label className="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-4">Subject Line</label>
                                <input
                                    type="text"
                                    value={subject}
                                    onChange={(e) => setSubject(e.target.value)}
                                    placeholder="Re: Opportunity for collaboration..."
                                    className="bg-slate-800/50 border border-white/10 rounded-2xl px-6 py-4 text-white font-bold focus:outline-none focus:border-indigo-500/50 transition-colors placeholder:text-slate-600"
                                />
                            </div>
                            <div className="flex flex-col gap-1">
                                <label className="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-4">Message Body</label>
                                <textarea
                                    value={body}
                                    onChange={(e) => setBody(e.target.value)}
                                    placeholder="Dear [Name], I am writing to you regarding..."
                                    className="bg-slate-800/50 border border-white/10 rounded-[2rem] px-8 py-8 text-white font-medium leading-relaxed focus:outline-none focus:border-indigo-500/50 transition-colors placeholder:text-slate-600 min-h-[400px] resize-none overflow-y-auto"
                                ></textarea>
                            </div>
                        </div>

                        <div className="flex items-center justify-between gap-6 pt-4">
                            <div className="text-slate-500 text-xs font-bold">
                                Word Count: <span className="text-slate-300 tabular-nums">{body.trim() ? body.trim().split(/\s+/).length : 0}</span>
                            </div>
                            <button
                                onClick={handleSubmit}
                                disabled={loading || body.length < 50}
                                className="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-400 hover:to-purple-500 px-10 py-5 rounded-2xl text-white font-black tracking-widest shadow-2xl shadow-indigo-500/20 transition-all hover:scale-[1.05] active:scale-95 disabled:opacity-30 disabled:hover:scale-100"
                            >
                                {loading ? 'REVIEWING...' : 'FINALIZE & SUBMIT'}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default EmailPro;
