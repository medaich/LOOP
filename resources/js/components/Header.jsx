import React from 'react';
import { Link, useLocation } from 'react-router-dom';

const Header = () => {
    const location = useLocation();

    return (
        <nav className="sticky top-4 z-50 mx-4 md:mx-8">
            <div className="bg-[#1E293B]/80 backdrop-blur-2xl border border-white/5 px-8 py-4 rounded-3xl shadow-2xl flex items-center justify-between">
                <Link to="/" className="flex items-center gap-3 group">
                    <div className="w-10 h-10 bg-indigo-500 rounded-2xl flex items-center justify-center text-xl shadow-lg shadow-indigo-500/20 group-hover:rotate-12 transition-transform">
                        🌀
                    </div>
                    <div className="flex flex-col">
                        <span className="font-black text-white text-lg tracking-tighter leading-none">LOOP</span>
                        <span className="text-[8px] font-black text-indigo-400 uppercase tracking-[0.3em] leading-none">Mastery v1.0</span>
                    </div>
                </Link>

                <div className="hidden md:flex items-center gap-2">
                    <HeaderLink to="/" active={location.pathname === '/' || location.pathname === '/dashboard'} label="DASHBOARD" />
                    <HeaderLink to="/leaderboard" active={location.pathname === '/leaderboard'} label="RANKINGS" />
                    <HeaderLink to="/badges" active={location.pathname === '/badges'} label="TROPHIES" />
                    <HeaderLink to="/peer-review" active={location.pathname === '/peer-review'} label="CRITIQUE" />
                </div>

                <div className="flex items-center gap-4">
                    <div className="hidden sm:flex flex-col items-end">
                        <span className="text-[10px] font-black text-slate-500 uppercase tracking-widest leading-none">Network</span>
                        <span className="text-[10px] font-black text-emerald-400 uppercase tracking-widest leading-none mt-1">SECURE_LIVE</span>
                    </div>
                    <div className="relative group">
                        <div className="w-10 h-10 rounded-full border border-white/10 bg-slate-800 flex items-center justify-center cursor-pointer hover:border-indigo-500/50 transition-colors">
                            👤
                        </div>
                        <div className="absolute right-0 top-12 w-48 bg-[#1E293B] border border-white/10 rounded-2xl shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 overflow-hidden">
                            <div className="p-4 border-b border-white/5">
                                <p className="text-xs font-bold text-white">Admin User</p>
                                <p className="text-[10px] text-slate-400 mt-1">admin@communicationlms.com</p>
                            </div>
                            <button
                                onClick={() => {
                                    // Clear any stored auth data
                                    localStorage.clear();
                                    sessionStorage.clear();
                                    // Reload to reset state
                                    window.location.href = '/';
                                }}
                                className="w-full px-4 py-3 text-left text-xs font-bold text-red-400 hover:bg-red-500/10 transition-colors flex items-center gap-2"
                            >
                                <span>🚪</span>
                                <span>SIGN OUT</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    );
};

const HeaderLink = ({ to, active, label }) => (
    <Link
        to={to}
        className={`px-6 py-2 rounded-xl text-[10px] font-black tracking-widest transition-all ${active
                ? 'bg-white text-slate-900 shadow-xl'
                : 'text-slate-400 hover:text-white hover:bg-white/5'
            }`}
    >
        {label}
    </Link>
);

export default Header;
