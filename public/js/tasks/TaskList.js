function TaskList({ tasks, setEditTask, setDeleteModal, setChangeTaskStatus }) {
    return (
        <ul>
            {tasks.map(task => (
                <li
                    key={task.id}
                    className="bg-gray-100 p-4 mb-2 rounded flex justify-between items-center"
                >
                    <div>
                        <strong>{task.title}</strong> -  
                        <span
                                className={`ml-2 text-sm px-2 py-1 rounded ${
                                    task.status === 'pending'
                                        ? 'bg-red-400 text-white'
                                        : 'bg-green-400 text-white'
                                }`}
                            >
                                {task.status.charAt(0).toUpperCase() + task.status.slice(1)}
                            </span>
                            <span
                            onClick={() => setChangeTaskStatus(task.id, task.status)}
                            className="cursor-pointer bg-gray-200 hover:bg-gray-300 text-gray-800 px-2 py-1 rounded ml-2"
                            title={`Mark as ${task.status === 'pending' ? 'Completed' : 'Pending'}`}
                                >
                                    <i className="fas fa-sync-alt"></i>
                                </span>
                        <br/>
                        <strong>Due Date : </strong>{task.due_date}
                    </div>
                    <div>

                    

                        <button
                            onClick={() =>
                                setEditTask({
                                    id: task.id,
                                    title: task.title,
                                    description: task.description,
                                    due_date: task.due_date,
                                })
                            }
                            className="bg-yellow-500 text-white px-2 py-1 rounded mr-2"
                        >
                            Edit
                        </button>
                        <button
                            onClick={() =>
                                setDeleteModal({ open: true, taskId: task.id })
                            }
                            className="bg-red-500 text-white px-2 py-1 rounded mr-2"
                        >
                            Delete
                        </button>
                        <button
                            onClick={() => (window.location.href = `/task/view/${task.id}`)}
                            className="bg-blue-500 text-white px-2 py-1 rounded"
                        >
                            View
                        </button>
                        
                        
                    </div>
                </li>
            ))}
        </ul>
    );
}
