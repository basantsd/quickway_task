function DeleteTaskModal({ deleteModal, setDeleteModal, handleDeleteTask }) {
    if (!deleteModal.open) return null;

    return (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
            <div className="bg-white p-4 rounded shadow-lg w-1/3">
                <h2 className="text-lg font-bold mb-4">Delete Task</h2>
                <p className="mb-4">Are you sure you want to delete this task? This action cannot be undone.</p>
                <div className="flex justify-end">
                    <button
                        onClick={() => handleDeleteTask(deleteModal.taskId)}
                        className="bg-red-500 text-white px-4 py-2 rounded mr-2"
                    >
                        Yes, Delete
                    </button>
                    <button
                        onClick={() => setDeleteModal({ open: false, taskId: null })}
                        className="bg-gray-500 text-white px-4 py-2 rounded"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    );
}
