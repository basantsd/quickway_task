function Notification({ notification }) {
    if (!notification) return null;

    const notificationStyles = notification.type === 'success' 
        ? 'bg-green-500 text-white' 
        : 'bg-red-500 text-white';

    return (
        <div className={`p-4 mb-4 rounded ${notificationStyles}`}>
            {notification.message}
        </div>
    );
}
