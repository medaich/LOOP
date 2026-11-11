import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';
import CVGame from './CVGame';
import EmailPro from './EmailPro';
import QuizGame from './QuizGame';
import VideoPitch from './VideoPitch';

const ExercisePage = () => {
    const { id } = useParams();
    const [exercise, setExercise] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        setLoading(true);
        // We use the quiz endpoint as it contains all needed data for MVP exercises
        axios.get(`/api/v1/quizzes/${id}`)
            .then(response => {
                setExercise(response.data);
                setLoading(false);
            })
            .catch(err => {
                console.error("Error fetching exercise type:", err);
                setError("Exercise not found.");
                setLoading(false);
            });
    }, [id]);

    if (loading) {
        return (
            <div className="flex items-center justify-center min-h-screen bg-[#0F172A] text-white">
                <div className="w-12 h-12 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
            </div>
        );
    }

    if (error || !exercise) {
        return (
            <div className="flex items-center justify-center min-h-screen bg-[#0F172A] text-white">
                <div className="bg-[#1E293B] p-10 rounded-[2rem] border border-white/5 text-center">
                    <p className="text-red-400 font-bold mb-4">{error || "Exercise data not found."}</p>
                    <button onClick={() => window.location.href = '/'} className="text-indigo-400 font-black uppercase tracking-widest text-xs">Back to safety</button>
                </div>
            </div>
        );
    }

    // Dispatch to the correct component based on the type in the database
    switch (exercise.type) {
        case 'cv':
            return <CVGame forcedId={id} />;
        case 'email':
            return <EmailPro forcedId={id} />;
        case 'video':
            return <VideoPitch forcedId={id} />;
        default:
            return <QuizGame forcedId={id} />;
    }
};

export default ExercisePage;
