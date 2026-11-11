import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useNavigate, Link } from 'react-router-dom';

const PeerReview = () => {
    const navigate = useNavigate();
    const [pitches, setPitches] = useState([]);
    const [selectedPitch, setSelectedPitch] = useState(null);
    const [scores, setScores] = useState({ clarity: 5, confidence: 5, body_language: 5, structure: 5 });
    const [feedback, setFeedback] = useState('');
    const [loading, setLoading] = useState(true);
    const [submitting, setSubmitting] = useState(false);
    const [success, setSuccess] = useState(false);

    useEffect(() => {
        const fetchPitches = async () => {
            try {
                const response = await axios.get('/api/v1/pitches/for-review');
                setPitches(Array.isArray(response.data.data) ? response.data.data : []);
            } catch (error) {
                console.error("Error fetching pitches:", error);
            } finally {
                setLoading(false);
            }
        };
        fetchPitches();
    }, []);

    const handleScoreChange = (criteria, value) => {
        setScores(prev => ({ ...prev, [criteria]: parseInt(value) }));
    };

    const handleSubmit = async () => {
        if (!selectedPitch || !feedback) return;
        setSubmitting(true);
        try {
            await axios.post(`/api/v1/pitches/${selectedPitch.id}/review`, {
                scores,
                feedback
            });
            setSuccess(true);
            // Remove the reviewed pitch from list
            setPitches(prev => prev.filter(p => p.id !== selectedPitch.id));
        } catch (error) {
            console.error("Review submission failed:", error);
        } finally {
            setSubmitting(false);
        }
    };

    if (loading) {
        return (
            <div className="flex items-center justify-center min-h-screen bg-[#0F172A] text-white">
                <div className="flex flex-col items-center gap-4">
                    <div className="w-10 h-10 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin" />
                    <p className="text-slate-500 font-bold uppercase tracking-widest text-xs">Finding available pitches...</p>
                </div>
            </div>
        );
    }

    if (success) {
        return (
            <div className="min-h-screen bg-[#0F172A] flex items-center justify-center p-4">
                <div className="bg-[#1E293B] p-12 rounded-[3.5rem] border border-white/5 shadow-3xl text-center max-w-lg">
                    <div className="text-7xl mb-6">🤝</div>
                    <h2 className="text-3xl font-black text-white mb-2 italic">CITIZEN SCIENTIST!</h2>
                    <p className="text-slate-400 mb-8 leading-relaxed font-medium">Your critique helps build a stronger community. You've been awarded <span className="text-emerald-400 font-black">+25 XP</span> for your contribution.</p>
                    <div className="flex flex-col gap-3">
                        <button
                            onClick={() => { setSuccess(false); setSelectedPitch(null); setFeedback(''); }}
                            className="w-full bg-white text-slate-900 font-black py-4 rounded-2xl hover:scale-[1.02] transition-all"
                        >
                            REVIEW ANOTHER PITCH
                        </button>
                        <button
                            onClick={() => navigate('/')}
                            className="w-full bg-slate-800 text-slate-400 hover:text-white font-black py-4 rounded-2xl transition-all"
                        >
                            DASHBOARD
                        </button>
                    </div>
                </div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-[#0F172A] text-slate-200 p-4 md:p-8 font-sans">
            <div className="max-w-6xl mx-auto space-y-12">
                <div className="text-center space-y-2">
                    <h1 className="text-4xl md:text-5xl font-black text-white tracking-tighter uppercase italic">Critique <span className="text-indigo-400">Lab</span></h1>
                    <p className="text-slate-500 font-bold uppercase tracking-[0.2em] text-xs">Help your peers reach their potential</p>
                </div>

                {!selectedPitch ? (
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        {pitches.map(pitch => (
                            <div
                                key={pitch.id}
                                className="group bg-[#1E293B] rounded-[2rem] p-6 border border-white/5 hover:border-indigo-500/30 transition-all hover:shadow-2xl cursor-pointer"
                                onClick={() => setSelectedPitch(pitch)}
                            >
                                <div className="aspect-video bg-black rounded-2xl mb-6 overflow-hidden relative shadow-inner">
                                    <div className="absolute inset-0 flex items-center justify-center">
                                        <span className="text-4xl group-hover:scale-125 transition-transform duration-500">▶️</span>
                                    </div>
                                    <div className="absolute top-4 left-4 flex gap-2">
                                        <span className="bg-indigo-500 text-white text-[8px] font-black px-2 py-1 rounded-md">V-PITCH</span>
                                    </div>
                                </div>
                                <h3 className="text-xl font-black text-white mb-2 line-clamp-1">{pitch.title}</h3>
                                <p className="text-sm text-slate-500 mb-6 font-medium">By {pitch.user?.name || 'Anonymous'}</p>
                                <button className="w-full bg-slate-800 group-hover:bg-indigo-600 font-black py-3 rounded-xl transition-all text-xs tracking-widest">
                                    START AUDIT
                                </button>
                            </div>
                        ))}
                        {pitches.length === 0 && (
                            <div className="col-span-full py-20 text-center bg-[#1E293B] rounded-[3rem] border border-dashed border-slate-700/50">
                                <p className="text-slate-500 font-black uppercase tracking-widest italic">All current pitches have been analyzed. Come back later.</p>
                            </div>
                        )}
                    </div>
                ) : (
                    <div className="grid grid-cols-1 lg:grid-cols-3 gap-12">
                        <div className="lg:col-span-2 space-y-6">
                            <div className="aspect-video bg-black rounded-[2.5rem] overflow-hidden border-4 border-[#1E293B] shadow-2xl">
                                <video src={selectedPitch.video_url} controls className="w-full h-full object-cover" />
                            </div>
                            <div className="bg-[#1E293B] p-8 rounded-[2rem] border border-white/5">
                                <h2 className="text-2xl font-black text-white mb-4 italic uppercase">{selectedPitch.title}</h2>
                                <p className="text-slate-400 leading-relaxed font-medium">{selectedPitch.description}</p>
                            </div>
                        </div>

                        <div className="bg-[#1E293B] rounded-[2.5rem] p-10 border border-white/5 shadow-2xl space-y-10">
                            <div>
                                <h3 className="text-xs font-black text-slate-500 uppercase tracking-widest mb-8">Score Matrix (1-10)</h3>
                                <div className="space-y-8">
                                    {Object.entries(scores).map(([criteria, value]) => (
                                        <div key={criteria} className="space-y-3">
                                            <div className="flex justify-between text-[10px] font-black uppercase tracking-widest">
                                                <span className="text-slate-400">{criteria.replace('_', ' ')}</span>
                                                <span className="text-indigo-400">{value}</span>
                                            </div>
                                            <input
                                                type="range" min="1" max="10" value={value}
                                                onChange={(e) => handleScoreChange(criteria, e.target.value)}
                                                className="w-full h-1.5 bg-slate-800 rounded-lg appearance-none cursor-pointer accent-indigo-500"
                                            />
                                        </div>
                                    ))}
                                </div>
                            </div>

                            <div className="space-y-4">
                                <label className="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-4">Constructive Feedback</label>
                                <textarea
                                    value={feedback}
                                    onChange={(e) => setFeedback(e.target.value)}
                                    placeholder="Be specific about improvements..."
                                    className="w-full bg-slate-900/50 border border-white/10 rounded-3xl p-6 text-white text-sm font-medium focus:outline-none focus:border-indigo-500/50 transition-colors min-h-[150px] resize-none"
                                />
                            </div>

                            <div className="flex gap-4">
                                <button
                                    onClick={() => setSelectedPitch(null)}
                                    className="flex-1 bg-slate-800 text-slate-400 font-black py-4 rounded-2xl hover:bg-slate-700 transition-all font-xs tracking-widest"
                                >
                                    BACK
                                </button>
                                <button
                                    onClick={handleSubmit}
                                    disabled={submitting || !feedback}
                                    className="flex-[2] bg-white text-slate-900 font-black py-4 rounded-2xl hover:scale-[1.02] active:scale-95 disabled:opacity-30 transition-all shadow-xl font-xs tracking-widest"
                                >
                                    {submitting ? 'RECORDING...' : 'PUBLISH AUDIT'}
                                </button>
                            </div>
                        </div>
                    </div>
                )}
            </div>
        </div>
    );
};

export default PeerReview;
