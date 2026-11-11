import React, { useState, useEffect } from 'react';
import axios from 'axios';

const Leaderboard = () => {
    const [leaders, setLeaders] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchLeaders = async () => {
            setLoading(true);
            try {
                const response = await axios.get('/api/v1/leaderboard');
                setLeaders(response.data.data);
            } catch (error) {
                console.error('Error fetching leaderboard:', error);
            } finally {
                setLoading(false);
            }
        };

        fetchLeaders();
    }, [window.location.pathname]); // Refresh on route change

    if (loading) {
        return (
            <div className="flex items-center justify-center min-h-screen bg-[#0F172A] text-white">
                <div className="flex flex-col items-center gap-4">
                    <div className="w-12 h-12 rounded-full border-4 border-indigo-500 border-t-transparent animate-spin" />
                    <p className="text-slate-500 font-black uppercase tracking-widest">Scanning Champions...</p>
                </div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-[#0F172A] text-slate-200 p-4 md:p-8 font-sans">
            <div className="max-w-4xl mx-auto">
                <div className="text-center mb-16 relative">
                    <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-indigo-500/10 rounded-full blur-[80px] -z-10" />
                    <h1 className="text-5xl md:text-6xl font-black text-white mb-6 tracking-tighter">
                        World <span className="text-indigo-400">Rankings</span>
                    </h1>
                    <p className="text-slate-500 max-w-md mx-auto leading-relaxed italic">
                        "Success is not final, failure is not fatal: it is the courage to continue that counts."
                    </p>
                </div>

                <div className="bg-[#1E293B] rounded-[2.5rem] border border-white/5 overflow-hidden shadow-2xl relative">
                    <div className="absolute top-0 left-0 w-full h-[6px] bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500" />
                    <div className="overflow-x-auto">
                        <table className="w-full text-left">
                            <thead className="bg-slate-800/40">
                                <tr className="border-b border-white/5 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">
                                    <th className="px-8 py-6 text-center">Rank</th>
                                    <th className="px-8 py-6">Architect</th>
                                    <th className="px-8 py-6 text-center">Tier</th>
                                    <th className="px-8 py-6 text-right">Contribution</th>
                                    <th className="px-8 py-6 text-center">Heat</th>
                                </tr>
                            </thead>
                            <tbody className="divide-y divide-white/[0.03]">
                                {leaders.map((user, index) => (
                                    <tr key={user.id || index} className="hover:bg-indigo-500/[0.02] transition-colors group">
                                        <td className="px-8 py-6 text-center">
                                            <div className="flex items-center justify-center">
                                                <span className={`inline-flex items-center justify-center w-10 h-10 rounded-2xl font-black text-lg ${user.rank === 1 ? 'bg-yellow-500/10 text-yellow-500 border border-yellow-500/20 shadow-[0_0_20px_rgba(234,179,8,0.1)]' :
                                                    user.rank === 2 ? 'bg-slate-300/10 text-slate-300 border border-slate-300/20' :
                                                        user.rank === 3 ? 'bg-orange-500/10 text-orange-400 border border-orange-500/20' :
                                                            'text-slate-600 bg-slate-800/50'
                                                    }`}>
                                                    {user.rank <= 3 ? (user.rank === 1 ? '🥇' : user.rank === 2 ? '🥈' : '🥉') : user.rank}
                                                </span>
                                            </div>
                                        </td>
                                        <td className="px-8 py-6">
                                            <div className="flex items-center gap-4">
                                                <div className="relative">
                                                    <div className="w-12 h-12 rounded-2xl bg-gradient-to-br from-slate-700 to-slate-900 flex items-center justify-center text-white font-black text-lg shadow-xl border border-white/5 group-hover:scale-110 transition-transform">
                                                        {user.name.charAt(0)}
                                                    </div>
                                                    {user.streak > 0 && (
                                                        <div className="absolute -top-1 -right-1 bg-red-500 text-[8px] font-black text-white px-1.5 py-0.5 rounded-full border-2 border-[#1E293B]">
                                                            HOT
                                                        </div>
                                                    )}
                                                </div>
                                                <div className="flex flex-col">
                                                    <span className="font-extrabold text-white text-lg tracking-tight group-hover:text-indigo-400 transition-colors uppercase">
                                                        {user.name}
                                                    </span>
                                                    <span className="text-[10px] font-black text-slate-500 tracking-widest">MEMBER SINCE 2024</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td className="px-8 py-6 text-center">
                                            <span className="text-indigo-400 font-black bg-indigo-500/10 px-4 py-1.5 rounded-xl text-[10px] border border-indigo-400/20 uppercase tracking-widest">
                                                Level {user.level}
                                            </span>
                                        </td>
                                        <td className="px-8 py-6 text-right">
                                            <span className="font-black text-emerald-400 text-lg tabular-nums">
                                                {user.xp.toLocaleString()}
                                            </span>
                                            <span className="text-[10px] font-black text-slate-500 ml-1">XP</span>
                                        </td>
                                        <td className="px-8 py-6 text-center">
                                            <span className="font-black text-orange-400 text-lg">
                                                {user.streak > 0 ? `${user.streak}` : '0'}
                                                <span className="text-xl ml-1">🔥</span>
                                            </span>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default Leaderboard;
