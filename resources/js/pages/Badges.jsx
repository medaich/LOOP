import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';

const Badges = () => {
    const [badges, setBadges] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchBadges = async () => {
            try {
                const response = await axios.get('/api/v1/dashboard');
                setBadges(response.data.recent_badges || []);
            } catch (error) {
                console.error("Error fetching badges:", error);
            } finally {
                setLoading(false);
            }
        };
        fetchBadges();
    }, []);

    return (
        <div className="min-h-screen bg-[#0F172A] text-slate-200 p-4 md:p-8 font-sans">
            <div className="max-w-6xl mx-auto space-y-12">
                <div className="text-center space-y-4">
                    <h1 className="text-5xl md:text-6xl font-black text-white tracking-tighter">Achievement <span className="text-indigo-400">Vault</span></h1>
                    <p className="text-slate-400 max-w-xl mx-auto text-lg leading-relaxed">
                        Your professional growth is etched in these digital artifacts. Every badge represents a hurdle cleared and a skill mastered.
                    </p>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-4 gap-8">
                    {/* Earned Badges Section */}
                    <div className="md:col-span-3 space-y-8">
                        <div className="bg-[#1E293B] rounded-[2.5rem] border border-white/5 p-10 shadow-2xl relative overflow-hidden">
                            <div className="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-purple-600" />
                            <h2 className="text-2xl font-black text-white mb-10 flex items-center gap-3">
                                <span className="p-2 bg-indigo-500/10 rounded-xl text-indigo-400">🏆</span>
                                Earned Recognitions
                            </h2>

                            {loading ? (
                                <div className="grid grid-cols-2 md:grid-cols-4 gap-8">
                                    {[1, 2, 3, 4].map(i => (
                                        <div key={i} className="animate-pulse flex flex-col items-center gap-4">
                                            <div className="w-20 h-20 bg-slate-800 rounded-3xl" />
                                            <div className="h-4 w-20 bg-slate-800 rounded-full" />
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="grid grid-cols-2 lg:grid-cols-4 gap-8">
                                    {badges.map((badge) => (
                                        <div key={badge.id} className="group relative flex flex-col items-center text-center">
                                            <div className="absolute inset-0 bg-indigo-500/20 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition duration-500" />
                                            <div className="relative z-10 w-24 h-24 bg-gradient-to-br from-slate-700 to-slate-900 rounded-[2rem] border border-white/10 flex items-center justify-center text-5xl shadow-2xl group-hover:-translate-y-3 transition-all duration-500 group-hover:shadow-indigo-500/20">
                                                {badge.icon || '🏅'}
                                                <div className="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity rounded-[2rem]" />
                                            </div>
                                            <h3 className="mt-6 font-black text-white text-sm tracking-widest uppercase">{badge.name}</h3>
                                            <p className="mt-2 text-[10px] font-bold text-slate-500 leading-tight px-2">{badge.description}</p>
                                        </div>
                                    ))}
                                    {badges.length === 0 && (
                                        <div className="col-span-full py-20 text-center border-2 border-dashed border-slate-700/50 rounded-3xl">
                                            <p className="text-slate-500 font-bold">Your journey has just begun. Complete your first exercise to unlock a badge.</p>
                                        </div>
                                    )}
                                </div>
                            )}
                        </div>
                    </div>

                    {/* Stats/Sidebar */}
                    <div className="space-y-6">
                        <div className="bg-indigo-600/10 border border-indigo-500/20 p-8 rounded-[2rem] text-center">
                            <h3 className="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-4">Mastery Rank</h3>
                            <div className="text-5xl font-black text-white mb-2">{badges.length}</div>
                            <p className="text-xs text-indigo-300/60 font-bold uppercase tracking-widest">Badges Secured</p>
                        </div>

                        <div className="bg-[#1E293B] border border-white/5 p-8 rounded-[2rem] space-y-6">
                            <h3 className="text-xs font-black text-white uppercase tracking-widest">Next Milestone</h3>
                            <div className="flex items-center gap-4 group">
                                <div className="w-12 h-12 rounded-xl bg-slate-800 flex items-center justify-center text-xl grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all">
                                    🔥
                                </div>
                                <div className="flex-1">
                                    <h4 className="text-xs font-black text-white tracking-widest uppercase">Streak Master</h4>
                                    <p className="text-[10px] text-slate-500 font-bold">Maintain a 7-day streak</p>
                                </div>
                            </div>
                            <div className="flex items-center gap-4 group">
                                <div className="w-12 h-12 rounded-xl bg-slate-800 flex items-center justify-center text-xl grayscale opacity-50 group-hover:grayscale-0 group-hover:opacity-100 transition-all">
                                    💯
                                </div>
                                <div className="flex-1">
                                    <h4 className="text-xs font-black text-white tracking-widest uppercase">Perfectionist</h4>
                                    <p className="text-[10px] text-slate-500 font-bold">Get 100% on 5 exercises</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="flex justify-center pt-8">
                    <Link to="/" className="bg-slate-800 hover:bg-slate-700 text-white font-black px-10 py-5 rounded-2xl transition-all tracking-widest uppercase text-xs shadow-xl">
                        Return to Control Center
                    </Link>
                </div>
            </div>
        </div>
    );
};

export default Badges;
