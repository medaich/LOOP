import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Header from './Header';
import Dashboard from '../pages/Dashboard';
import Leaderboard from '../pages/Leaderboard';
import ExercisePage from '../pages/ExercisePage';
import Badges from '../pages/Badges';
import PeerReview from '../pages/PeerReview';

const App = () => {
    return (
        <Router>
            <Header />
            <main className="min-h-screen bg-[#0F172A]">
                <Routes>
                    <Route path="/" element={<Dashboard />} />
                    <Route path="/dashboard" element={<Dashboard />} />
                    <Route path="/leaderboard" element={<Leaderboard />} />
                    <Route path="/badges" element={<Badges />} />
                    <Route path="/exercise/:id" element={<ExercisePage />} />
                    <Route path="/exercises" element={<Dashboard />} />
                    <Route path="/peer-review" element={<PeerReview />} />
                </Routes>
            </main>
        </Router>
    );
};

export default App;
