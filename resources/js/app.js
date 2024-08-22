// Import the default bootstrap setup
import './bootstrap';

// Ensure Filament and its plugins are initialized
document.addEventListener('DOMContentLoaded', () => {
    // Check if Filament is loaded and initialized
    window.filament = window.filament || {};

    // Example: Initialize Knowledge Base plugin (adjust this if needed)
    if (typeof filament.knowledgeBase !== 'undefined' && typeof filament.knowledgeBase.initialize === 'function') {
        filament.knowledgeBase.initialize();
    }

    // Add any other custom initialization logic here
    console.log('Custom JavaScript initialized.');
});
