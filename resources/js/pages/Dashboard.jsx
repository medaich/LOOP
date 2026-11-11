import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';

const Dashboard = () => {
    const [data, setData] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await axios.get('/api/v1/dashboard');
                setData(response.data);
            } catch (error) {
                console.error('Error fetching dashboard data:', error);
            } finally {
                setLoading(false);
            }
        };

        fetchData();
    }, []);

    if (loading) {
        return (
            <div className="flex items-center justify-center min-h-screen bg-[#0F172A] text-white font-sans">
                <div className="animate-pulse flex flex-col items-center gap-4">
                    <div className="w-12 h-12 rounded-full border-4 border-indigo-500 border-t-transparent animate-spin" />
                    <p className="text-slate-400 font-medium">Loading your journey...</p>
                </div>
            </div>
        );
    }

    if (!data) {
        return <div className="flex items-center justify-center min-h-screen bg-[#0F172A] text-white">Error loading dashboard</div>;
    }

    const { user, stats, recent_badges, recent_activity, available_courses } = data;

    return (
        <div className="min-h-screen bg-[#0F172A] text-slate-200 p-4 md:p-8 font-sans">
            <div className="max-w-7xl mx-auto space-y-8">
                {/* Header Section */}
                <div className="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h1 className="text-3xl md:text-5xl font-extrabold text-white mb-2 tracking-tight">
                            Welcome back, <span className="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">{user?.name}</span>!
                        </h1>
                        <p className="text-slate-400 text-lg">Master your communication, level up your future.</p>
                    </div>
                    <div className="flex items-center gap-4 md:gap-8 bg-[#1E293B]/80 backdrop-blur-xl p-5 rounded-3xl border border-slate-700/50 shadow-2xl">
                        <div className="text-center group">
                            <p className="text-[10px] text-slate-500 uppercase font-black tracking-[0.2em] mb-1 group-hover:text-indigo-400 transition-colors">Level</p>
                            <span className="text-3xl font-black text-white">{stats?.level}</span>
                        </div>
                        <div className="h-12 w-px bg-slate-700/50" />
                        <div className="text-center group">
                            <p className="text-[10px] text-slate-500 uppercase font-black tracking-[0.2em] mb-1 group-hover:text-emerald-400 transition-colors">XP</p>
                            <span className="text-3xl font-black text-white">{stats?.xp}</span>
                        </div>
                        <div className="h-12 w-px bg-slate-700/50" />
                        <div className="text-center group">
                            <p className="text-[10px] text-slate-500 uppercase font-black tracking-[0.2em] mb-1 group-hover:text-orange-400 transition-colors">Streak</p>
                            <span className="text-3xl font-black text-white">{stats?.streak}🔥</span>
                        </div>
                    </div>
                </div>

                {/* Progress Hero */}
                <div className="relative group">
                    <div className="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-[2.5rem] blur opacity-25 group-hover:opacity-40 transition duration-1000 group-hover:duration-200" />
                    <div className="relative bg-[#1E293B] rounded-[2rem] p-8 md:p-10 shadow-3xl overflow-hidden border border-white/5">
                        <div className="absolute top-0 right-0 p-8 text-[12rem] opacity-[0.03] select-none pointer-events-none">
                            🎓
                        </div>
                        <div className="flex flex-col md:flex-row items-center gap-10">
                            <div className="relative">
                                <div className="w-24 h-24 md:w-32 md:h-32 rounded-3xl bg-indigo-500/10 flex items-center justify-center text-4xl md:text-5xl border border-indigo-500/20 shadow-inner">
                                    🚀
                                </div>
                                <div className="absolute -bottom-2 -right-2 bg-emerald-500 text-white p-2 rounded-xl text-xs font-black shadow-lg">
                                    {user?.progress_percentage}%
                                </div>
                            </div>
                            <div className="flex-1 space-y-6 w-full text-center md:text-left">
                                <div className="flex flex-col md:flex-row md:items-end justify-between gap-2">
                                    <div>
                                        <h2 className="text-2xl font-black text-white tracking-tight">Level {stats?.level} Progress</h2>
                                        <p className="text-slate-400">Complete more exercises to reach Level {stats?.level + 1}</p>
                                    </div>
                                    <div className="text-slate-500 font-mono text-xs">
                                        {stats?.xp} / {stats?.xp_to_next_level} XP
                                    </div>
                                </div>
                                <div className="relative h-4 w-full bg-slate-800 rounded-full border border-white/5 p-0.5 overflow-hidden">
                                    <div
                                        className="h-full bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-full transition-all duration-1000 ease-out shadow-[0_0_20px_rgba(99,102,241,0.5)]"
                                        style={{ width: `${user?.progress_percentage || 0}%` }}
                                    >
                                        <div className="w-full h-full bg-[linear-gradient(45deg,rgba(255,255,255,0.2)_25%,transparent_25%,transparent_50%,rgba(255,255,255,0.2)_50%,rgba(255,255,255,0.2)_75%,transparent_75%,transparent)] bg-[length:20px_20px] animate-[progress-stripe_1s_linear_infinite]" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div className="lg:col-span-2 space-y-8">
                        {/* Courses */}
                        <section className="space-y-6">
                            <div className="flex items-center justify-between px-2">
                                <h2 className="text-2xl font-black text-white tracking-tight">Active Learning Tracks</h2>
                                <Link to="/exercises" className="text-sm font-bold text-indigo-400 hover:text-indigo-300 transition-colors">See all modules</Link>
                            </div>
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {available_courses?.map(course => (
                                    <div key={course.id} className="group bg-[#1E293B]/50 hover:bg-[#1E293B] border border-slate-700/50 p-6 rounded-3xl transition-all duration-300 hover:shadow-2xl hover:border-indigo-500/50 relative overflow-hidden">
                                        <div className="absolute top-0 right-0 w-32 h-32 bg-indigo-500/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700" />
                                        <div className="flex justify-between items-start mb-6 relative">
                                            <div className="bg-slate-800 p-3 rounded-2xl text-2xl group-hover:scale-110 transition-transform border border-slate-700/50">
                                                📖
                                            </div>
                                            <div className="flex gap-2">
                                                <span className="text-[10px] font-black text-emerald-400 bg-emerald-400/10 px-2 py-1 rounded-lg border border-emerald-400/10">
                                                    {course.quizzes_count} EXERCISES
                                                </span>
                                            </div>
                                        </div>
                                        <h3 className="text-xl font-black text-white mb-3 group-hover:text-indigo-400 transition-colors">{course.title}</h3>
                                        <p className="text-sm text-slate-400 mb-6 line-clamp-2 leading-relaxed">{course.description}</p>
                                        <Link
                                            to={`/exercise/${course.first_quiz_id || course.id}`}
                                            className="inline-flex items-center gap-2 bg-slate-800 hover:bg-indigo-600 px-6 py-2.5 rounded-xl text-sm font-black text-white transition-all group-hover:shadow-[0_10px_20px_rgba(79,70,229,0.3)]"
                                        >
                                            RESUME <span className="text-xs">→</span>
                                        </Link>
                                    </div>
                                ))}
                            </div>
                        </section>

                        {/* Activity */}
                        <section className="bg-[#1E293B] rounded-[2rem] p-8 border border-slate-700/50 shadow-xl overflow-hidden relative">
                            <div className="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-slate-600 to-transparent opacity-20" />
                            <h2 className="text-xl font-black text-white mb-8 tracking-tight flex items-center gap-2">
                                <span className="w-2 h-2 rounded-full bg-indigo-500" /> Recent Accomplishments
                            </h2>
                            <div className="space-y-4">
                                {recent_activity?.map(activity => (
                                    <div key={activity.id} className="flex items-center gap-5 p-4 rounded-2xl hover:bg-slate-800/80 transition-all border border-transparent hover:border-slate-700/50 group">
                                        <div className="w-12 h-12 rounded-2xl bg-slate-700/50 flex items-center justify-center text-xl shadow-inner group-hover:scale-110 transition-transform">
                                            {activity.quiz?.type === 'cv' ? '📄' : '📧'}
                                        </div>
                                        <div className="flex-1 min-w-0">
                                            <h4 className="text-white font-bold truncate group-hover:text-indigo-400 transition-colors">{activity.quiz?.title}</h4>
                                            <p className="text-xs text-slate-500 font-medium uppercase tracking-wider">{new Date(activity.completed_at).toLocaleDateString()}</p>
                                        </div>
                                        <div className="text-right">
                                            <div className="text-emerald-400 font-black text-lg">+{activity.xp_earned}</div>
                                            <div className="text-[10px] text-slate-500 font-bold bg-slate-800 px-2 py-0.5 rounded-md border border-slate-700">SCORE: {activity.score}%</div>
                                        </div>
                                    </div>
                                ))}
                                {!recent_activity?.length && (
                                    <div className="py-12 text-center text-slate-500 font-medium italic bg-slate-800/10 rounded-2xl border border-dashed border-slate-700/50">
                                        No entries in your ledger yet. Create your legacy.
                                    </div>
                                )}
                            </div>
                        </section>
                    </div>

                    <div className="space-y-8">
                        {/* Summary Grid */}
                        <div className="grid grid-cols-2 gap-4">
                            <div className="bg-[#1E293B] border border-slate-700/50 p-6 rounded-[2rem] hover:bg-[#1E293B]/80 transition-colors shadow-lg group">
                                <span className="text-3xl block mb-4 group-hover:scale-110 transition-transform">✅</span>
                                <span className="text-2xl font-black text-white block">{stats?.exercises_completed}</span>
                                <p className="text-[10px] text-slate-500 font-black uppercase tracking-[0.1em]">Solved</p>
                            </div>
                            <div className="bg-[#1E293B] border border-slate-700/50 p-6 rounded-[2rem] hover:bg-[#1E293B]/80 transition-colors shadow-lg group">
                                <span className="text-3xl block mb-4 group-hover:rotate-12 transition-transform">🔝</span>
                                <span className="text-2xl font-black text-white block">#{stats?.global_rank}</span>
                                <p className="text-[10px] text-slate-500 font-black uppercase tracking-[0.1em]">Global</p>
                            </div>
                        </div>

                        {/* Recent Badges */}
                        <section className="bg-gradient-to-b from-[#1E293B] to-[#0F172A] rounded-[2rem] p-8 border border-white/5 shadow-2xl">
                            <div className="flex items-center justify-between mb-8">
                                <h2 className="text-lg font-black text-white uppercase tracking-widest">Hall of Fame</h2>
                                <Link to="/badges" className="text-[10px] font-black text-indigo-400 hover:text-indigo-300">SEE ALL</Link>
                            </div>
                            <div className="grid grid-cols-2 gap-6">
                                {recent_badges?.map(badge => (
                                    <div key={badge.id} className="relative group/badge flex flex-col items-center">
                                        <div className="absolute -inset-2 bg-indigo-500/20 rounded-full blur opacity-0 group-hover/badge:opacity-100 transition duration-500" />
                                        <div className="w-16 h-16 rounded-3xl bg-slate-800 flex items-center justify-center text-4xl shadow-2xl border border-slate-700/50 group-hover/badge:-translate-y-2 transition-all duration-500 relative z-10">
                                            {badge.icon || '🏅'}
                                        </div>
                                        <span className="mt-3 text-[10px] text-slate-400 font-black text-center break-words opacity-0 group-hover/badge:opacity-100 transition-opacity duration-300">{badge.name.toUpperCase()}</span>
                                    </div>
                                ))}
                                {!recent_badges?.length && (
                                    <div className="col-span-full py-8 text-center text-slate-600 text-xs font-bold leading-relaxed px-4">
                                        Your trophy case is waiting for its first masterpiece.
                                    </div>
                                )}
                            </div>
                        </section>

                        {/* Quick Tip */}
                        <div className="bg-indigo-600/10 border border-indigo-500/20 p-6 rounded-[2rem]">
                            <h4 className="text-xs font-black text-indigo-400 uppercase tracking-widest mb-2 italic">Dopamine Tip</h4>
                            <p className="text-xs text-slate-400 leading-relaxed">
                                Reviewing a peer's video pitch awards you <span className="text-indigo-300 font-bold">25 XP</span> instantly. It's the fastest way to bridge the gap to Level {stats?.level + 1}!
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <style dangerouslySetInnerHTML={{
                __html: `
                @keyframes progress-stripe {
                    from { background-position: 40px 0; }
                    to { background-position: 0 0; }
                }
            `}} />
        </div>
    );
};

export default Dashboard;
