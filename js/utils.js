window.chartColors = {
	red: '#C0392B',
	orange: '#d35400',
	yellow: '#F1C40F',
	green: '#27AE60',
        turkesa: '#16A085',
	blue: '#2980B9',
	purple: '#8E44AD',
	grey: '#7F8C8D',
        black: '#2C3E50',
        silver: '#7f8c8d',
        /*colores claros*/
        redclear: '#E74C3C',
        orangeclear: '#e67e22',
        yellowclear: '#f39c12',
	greenclear: '#2ECC71',
        turkesaclear: '#1ABC9C',
	blueclear: '#3498DB',
	purpleclear: '#9B59B6',
	greyclear: '#95A5A6',
        blackclear: '#34495E',
        silverclear: '#95a5a6'
};

window.randomScalingFactor = function() {
	return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
}