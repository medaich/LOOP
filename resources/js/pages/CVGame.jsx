import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useParams, useNavigate, Link } from 'react-router-dom';

const CVGame = ({ forcedId }) => {
    const { id: paramId } = useParams();
    const id = paramId || forcedId;
    const navigate = useNavigate();
    const [exercise, setExercise] = useState(null);
    const [userOrder, setUserOrder] = useState([]);
    const [result, setResult] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchExercise = async () => {
            try {
                // Fetching from a general exercise route or quiz route as defined in migrations
                const response = await axios.get(`/api/v1/quizzes/${id}`);
                setExercise(response.data);
                if (response.data.metadata?.sections) {
                    setUserOrder(response.data.metadata.sections);
                }
            } catch (error) {
                console.error("Error fetching exercise:", error);
            } finally {
                setLoading(false);
            }
        };
        fetchExercise();
    }, [id]);

    const moveItem = (index, direction) => {
        const newOrder = [...userOrder];
        const targetIndex = index + direction;
        if (targetIndex < 0 || targetIndex >= newOrder.length) return;

        [newOrder[index], newOrder[targetIndex]] = [newOrder[targetIndex], newOrder[index]];
        setUserOrder(newOrder);
    };

    const handleSubmit = async () => {
        setLoading(true);
        try {
            const response = await axios.post(`/api/v1/exercises/${id}/cv/submit`, {
                structure: userOrder.map(s => s.id)
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
                <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-indigo-500"></div>
            </div>
        );
    }

    if (result) {
        return (
            <div className="min-h-screen bg-[#0F172A] flex items-center justify-center p-4">
                <div className="bg-[#1E293B] p-10 rounded-[2.5rem] border border-white/5 shadow-2xl max-w-xl w-full text-center relative overflow-hidden">
                    <div className="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-indigo-500 to-purple-600" />
                    <div className="text-7xl mb-6">{result.score >= 80 ? '👑' : '🎯'}</div>
                    <h2 className="text-4xl font-black text-white mb-2">Analysis Complete</h2>
                    <div className="text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-indigo-400 mb-6">
                        {result.score}%
                    </div>

                    <div className="bg-slate-800/50 p-6 rounded-2xl mb-8 border border-white/5">
                        <p className="text-slate-300 leading-relaxed font-medium">
                            {result.feedback ? result.feedback[0] : "Great effort! Your structural understanding is improving."}
                        </p>
                    </div>

                    {result.xp_earned > 0 && (
                        <div className="mb-8 animate-bounce">
                            <span className="bg-emerald-500/20 text-emerald-400 px-6 py-2 rounded-full font-black text-xl border border-emerald-500/20">
                                +{result.xp_earned} XP
                            </span>
                        </div>
                    )}

                    <button
                        onClick={() => navigate('/')}
                        className="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-black py-4 rounded-2xl transition-all shadow-lg shadow-indigo-500/20"
                    >
                        RETURN TO DASHBOARD
                    </button>
                </div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-[#0F172A] text-slate-200 p-4 md:p-8 font-sans">
            <div className="max-w-4xl mx-auto space-y-8">
                <div className="flex items-center justify-between">
                    <Link to="/" className="text-slate-500 hover:text-white transition-colors font-bold flex items-center gap-2">
                        ← BACK
                    </Link>
                    <div className="px-4 py-1 bg-indigo-500/10 rounded-full border border-indigo-500/20">
                        <span className="text-xs font-black text-indigo-400 tracking-widest uppercase">Structural Integrity Mode</span>
                    </div>
                </div>

                <div className="space-y-2">
                    <h1 className="text-4xl md:text-5xl font-black text-white tracking-tight">{exercise?.title}</h1>
                    <p className="text-slate-400 text-lg leading-relaxed">{exercise?.description}</p>
                </div>

                <div className="bg-[#1E293B] rounded-[2rem] border border-white/5 p-8 shadow-2xl relative">
                    <div className="absolute top-0 right-0 p-8 text-8xl opacity-[0.02] pointer-events-none select-none">
                        📝
                    </div>

                    <p className="text-slate-400 font-bold mb-8 uppercase tracking-widest text-xs">Reorder sections to create the perfect CV flow:</p>

                    <div className="space-y-3 mb-10">
                        {userOrder.map((section, index) => (
                            <div
                                key={section.id}
                                className="group flex items-center gap-4 p-5 bg-slate-800/50 rounded-2xl border border-white/5 hover:border-indigo-500/30 hover:bg-slate-800 transition-all cursor-default shadow-sm"
                            >
                                <div className="flex flex-col gap-1">
                                    <button
                                        onClick={() => moveItem(index, -1)}
                                        disabled={index === 0}
                                        className="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-slate-700 transition-colors disabled:opacity-20"
                                    >
                                        ▲
                                    </button>
                                    <button
                                        onClick={() => moveItem(index, 1)}
                                        disabled={index === userOrder.length - 1}
                                        className="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-slate-700 transition-colors disabled:opacity-20"
                                    >
                                        ▼
                                    </button>
                                </div>
                                <div className="flex-1 flex items-center justify-between">
                                    <span className="font-extrabold text-white text-lg">{section.label}</span>
                                    <div className="w-1.5 h-6 rounded-full bg-slate-700 group-hover:bg-indigo-500 transition-colors" />
                                </div>
                            </div>
                        ))}
                    </div>

                    <button
                        onClick={handleSubmit}
                        disabled={loading}
                        className="group relative w-full bg-white text-slate-900 font-black py-5 rounded-2xl overflow-hidden transition-all hover:scale-[1.02] active:scale-95 disabled:opacity-50"
                    >
                        <div className="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity" />
                        <span className="relative z-10 group-hover:text-white transition-colors">
                            {loading ? 'ANALYZING...' : 'SUBMIT OPTIMIZED STRUCTURE'}
                        </span>
                    </button>
                </div>

                <div className="text-center">
                    <p className="text-slate-600 text-xs font-bold uppercase tracking-widest">
                        Tip: HR managers typically spend only 6 seconds on an initial CV scan.
                    </p>
                </div>
            </div>
        </div>
    );
};

export default CVGame;
