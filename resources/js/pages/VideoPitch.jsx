import React, { useState, useEffect, useRef } from 'react';
import axios from 'axios';
import { useParams, useNavigate, Link } from 'react-router-dom';

const VideoPitch = ({ forcedId }) => {
    const { id: paramId } = useParams();
    const id = paramId || forcedId;
    const navigate = useNavigate();
    const [exercise, setExercise] = useState(null);
    const [title, setTitle] = useState('');
    const [description, setDescription] = useState('');
    const [file, setFile] = useState(null);
    const [previewUrl, setPreviewUrl] = useState(null);
    const [isRecording, setIsRecording] = useState(false);
    const [loading, setLoading] = useState(true);
    const [submissionResult, setSubmissionResult] = useState(null);
    const videoRef = useRef(null);
    const mediaRecorderRef = useRef(null);

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

    const handleFileChange = (e) => {
        const selectedFile = e.target.files[0];
        if (selectedFile) {
            setFile(selectedFile);
            setPreviewUrl(URL.createObjectURL(selectedFile));
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        const formData = new FormData();
        formData.append('video', file);
        formData.append('title', title || exercise?.title);
        formData.append('description', description);

        try {
            const response = await axios.post(`/api/v1/pitches/${id}/submit`, formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
            setSubmissionResult(response.data);
        } catch (error) {
            console.error("Submission failed:", error);
        } finally {
            setLoading(false);
        }
    };

    if (submissionResult) {
        return (
            <div className="min-h-screen bg-[#0F172A] flex items-center justify-center p-4">
                <div className="bg-[#1E293B] p-12 rounded-[3rem] border border-white/5 shadow-3xl max-w-xl w-full text-center">
                    <div className="text-8xl mb-6">🎬</div>
                    <h2 className="text-4xl font-black text-white mb-4 italic tracking-tight">ROLLING!</h2>
                    <p className="text-slate-400 mb-8 font-medium">Your pitch has been submitted for peer review. You've earned <span className="text-emerald-400 font-black">+{submissionResult.data?.xp_earned || 100} XP</span> for going on camera!</p>
                    <button
                        onClick={() => navigate('/')}
                        className="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-black py-4 rounded-2xl transition-all"
                    >
                        BACK TO DASHBOARD
                    </button>
                </div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-[#0F172A] text-slate-200 p-4 md:p-8 font-sans">
            <div className="max-w-6xl mx-auto space-y-8">
                <div className="flex items-center justify-between">
                    <Link to="/" className="text-slate-500 hover:text-white transition-colors font-bold uppercase tracking-widest text-xs">← ABORT MISSION</Link>
                    <div className="px-4 py-1.5 bg-red-500/10 rounded-full border border-red-500/20">
                        <span className="text-[10px] font-black text-red-500 tracking-[0.2em] uppercase">Recording in Session</span>
                    </div>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    {/* Left: Recording/Preview */}
                    <div className="space-y-6">
                        <div className="relative aspect-video bg-black rounded-[2.5rem] overflow-hidden border-4 border-[#1E293B] shadow-2xl group">
                            {previewUrl ? (
                                <video src={previewUrl} controls className="w-full h-full object-cover" />
                            ) : (
                                <div className="w-full h-full flex flex-col items-center justify-center gap-4 bg-gradient-to-b from-slate-900 to-black">
                                    <div className="w-20 h-20 rounded-full bg-slate-800 flex items-center justify-center text-4xl group-hover:scale-110 transition-transform">
                                        📷
                                    </div>
                                    <p className="text-slate-500 font-black tracking-widest text-xs">NO INPUT DETECTED</p>
                                </div>
                            )}
                            <div className="absolute top-6 left-6 flex items-center gap-3">
                                <div className="w-3 h-3 rounded-full bg-red-500 animate-pulse shadow-[0_0_10px_rgba(239,68,68,0.5)]" />
                                <span className="text-[10px] font-black text-white uppercase tracking-[0.2em]">Live Preview</span>
                            </div>
                        </div>

                        <div className="grid grid-cols-2 gap-4">
                            <label className="flex flex-col items-center justify-center gap-3 p-8 bg-[#1E293B] hover:bg-[#2A3A52] border border-white/5 rounded-3xl transition-all cursor-pointer group">
                                <span className="text-2xl group-hover:rotate-12 transition-transform">📂</span>
                                <span className="text-[10px] font-black text-slate-400 uppercase tracking-widest">Upload Clip</span>
                                <input type="file" accept="video/*" onChange={handleFileChange} className="hidden" />
                            </label>
                            <button className="flex flex-col items-center justify-center gap-3 p-8 bg-red-500/10 hover:bg-red-500/20 border border-red-500/20 rounded-3xl transition-all group">
                                <span className="text-2xl group-hover:scale-125 transition-transform">🔴</span>
                                <span className="text-[10px] font-black text-red-400 uppercase tracking-widest">Start Rec</span>
                            </button>
                        </div>
                    </div>

                    {/* Right: Metadata */}
                    <div className="bg-[#1E293B] rounded-[3rem] p-10 border border-white/5 shadow-2xl flex flex-col justify-between">
                        <div className="space-y-8">
                            <div>
                                <h1 className="text-4xl font-black text-white mb-2 tracking-tight uppercase italic">{exercise?.title}</h1>
                                <p className="text-slate-400 leading-relaxed">{exercise?.description}</p>
                            </div>

                            <form className="space-y-6">
                                <div className="space-y-2">
                                    <label className="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-4">Pitch Headline</label>
                                    <input
                                        type="text"
                                        value={title}
                                        onChange={(e) => setTitle(e.target.value)}
                                        placeholder="e.g. 30-Second Elevator Pitch for Tech Role"
                                        className="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-6 py-4 text-white font-bold focus:outline-none focus:border-indigo-500/50 transition-colors"
                                    />
                                </div>
                                <div className="space-y-2">
                                    <label className="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-4">Key Objectives / Notes</label>
                                    <textarea
                                        value={description}
                                        onChange={(e) => setDescription(e.target.value)}
                                        placeholder="What should reviewers focus on? (Tone, Body Language, etc.)"
                                        className="w-full bg-slate-900/50 border border-white/10 rounded-3xl px-6 py-6 text-white font-medium focus:outline-none focus:border-indigo-500/50 transition-colors min-h-[150px] resize-none"
                                    />
                                </div>
                            </form>
                        </div>

                        <div className="pt-8">
                            <button
                                onClick={handleSubmit}
                                disabled={!file || loading}
                                className="w-full bg-white text-slate-900 hover:bg-slate-100 font-black py-5 rounded-2xl transition-all shadow-xl shadow-black/20 flex items-center justify-center gap-3 disabled:opacity-30 group"
                            >
                                <span className="group-hover:translate-x-1 transition-transform tracking-widest">TRANSMIT TO CLOUD</span>
                                <span className="text-xl">🚀</span>
                            </button>
                            <p className="text-center text-[10px] text-slate-500 font-bold mt-4 uppercase tracking-[0.2em] italic">
                                Ready for peer review encryption
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default VideoPitch;
