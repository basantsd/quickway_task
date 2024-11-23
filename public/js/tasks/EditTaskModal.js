function EditTaskModal({ editTask, setEditTask, handleEditTask }) {
    if (!editTask) return null;

    return (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
            <div className="bg-white p-4 rounded shadow-lg w-1/3">
                <h2 className="text-lg font-bold mb-4">Edit Task</h2>
                <input
                    type="text"
                    placeholder="Title"
                    value={editTask.title}
                    onChange={(e) => setEditTask({ ...editTask, title: e.target.value })}
                    className="w-full p-2 border rounded mb-2"
                />
                <textarea
                    placeholder="Description"
                    value={editTask.description}
                    onChange={(e) => setEditTask({ ...editTask, description: e.target.value })}
                    className="w-full p-2 border rounded mb-2" rows="8"
                ></textarea>
                <input
                    type="date"
                    value={editTask.due_date}
                    onChange={(e) => setEditTask({ ...editTask, due_date: e.target.value })}
                    className="w-full p-2 border rounded mb-2"
                />
                <div className="flex justify-end">
                    <button
                        onClick={handleEditTask}
                        className="bg-blue-500 text-white px-4 py-2 rounded mr-2"
                    >
                        Save
                    </button>
                    <button
                        onClick={() => setEditTask(null)}
                        className="bg-gray-500 text-white px-4 py-2 rounded"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    );
}
