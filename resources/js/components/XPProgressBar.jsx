import React from 'react';

const XPProgressBar = ({ currentXP, xpToNext, level }) => {
    const percentage = Math.min(100, Math.max(0, (currentXP / xpToNext) * 100));

    return (
        <div className="xp-container">
            <div style={{ display: 'flex', justifyContent: 'space-between', marginBottom: '0.5rem', fontWeight: 600 }}>
                <span>Level {level}</span>
                <span>{currentXP} / {xpToNext} XP</span>
            </div>
            <div className="xp-progress-bar">
                <div
                    className="xp-fill"
                    style={{ width: `${percentage}%` }}
                ></div>
            </div>
        </div>
    );
};

export default XPProgressBar;
