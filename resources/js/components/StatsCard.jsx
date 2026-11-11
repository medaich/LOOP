import React from 'react';

const StatsCard = ({ label, value, icon, color }) => {
    return (
        <div className="glass stats-card">
            <div className="stats-label">{label}</div>
            <div className="stats-value" style={{ color: color || 'inherit' }}>
                {value}
            </div>
            {icon && <div className="stats-icon">{icon}</div>}
        </div>
    );
};

export default StatsCard;
