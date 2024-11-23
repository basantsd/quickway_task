function AddTaskModal({ modalOpen, setModalOpen, newTask, setNewTask, handleAddTask }) {
    if (!modalOpen) return null;

    return (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
            <div className="bg-white p-4 rounded shadow-lg w-1/3">
                <h2 className="text-lg font-bold mb-4">Add New Task</h2>
                <input
                    type="text"
                    placeholder="Title"
                    value={newTask.title}
                    onChange={(e) => setNewTask({ ...newTask, title: e.target.value })}
                    className="w-full p-2 border rounded mb-2"
                />
                <textarea
                    placeholder="Description"
                    value={newTask.description}
                    onChange={(e) => setNewTask({ ...newTask, description: e.target.value })}
                    className="w-full p-2 border rounded mb-2" rows="8"
                ></textarea>
                <input
                    type="date"
                    value={newTask.due_date}
                    onChange={(e) => setNewTask({ ...newTask, due_date: e.target.value })}
                    className="w-full p-2 border rounded mb-2"
                />
                <div className="flex justify-end">
                    <button
                        onClick={handleAddTask}
                        className="bg-green-500 text-white px-4 py-2 rounded mr-2"
                    >
                        Add
                    </button>
                    <button
                        onClick={() => setModalOpen(false)}
                        className="bg-gray-500 text-white px-4 py-2 rounded"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    );
}
