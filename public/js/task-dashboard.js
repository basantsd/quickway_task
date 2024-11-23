const { useState, useEffect } = React;

function TaskDashboard() {
    const [tasks, setTasks] = useState([]);
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);
    const [newTask, setNewTask] = useState({ title: '', description: '', due_date: '' });
    const [editTask, setEditTask] = useState(null);
    const [filter, setFilter] = useState('all');
    const [searchQuery, setSearchQuery] = useState('');
    const [loading, setLoading] = useState(false);
    const [modalOpen, setModalOpen] = useState(false);
    const [deleteModal, setDeleteModal] = useState({ open: false, taskId: null });
    const [notification, setNotification] = useState(null);

    const notify = (message, type = 'success') => {
        setNotification({ message, type });
        setTimeout(() => setNotification(null), 3000);
    };

    const fetchTasks = async (page = 1, status = 'all', search = '') => {
        if(search == '') setLoading(true);
        try {
            const response = await axios.get(`/api/tasks`, {
                params: { page, status, search },
                headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
            });
            setTasks(response.data.data || []);
            setCurrentPage(response.data.current_page || 1);
            setTotalPages(response.data.last_page || 1);
        } catch (error) {
            console.error('Error fetching tasks:', error);
        } finally {
            if(search == '') setLoading(false);
        }
    };

    const handleAddTask = async () => {
        if (!newTask.title || !newTask.description || !newTask.due_date) {
            notify('All fields are required!', 'error');
            return;
        }
        try {
            const response = await axios.post('/api/tasks/add', newTask, {
                headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
            });
            setTasks([response.data, ...tasks]); 
            setNewTask({ title: '', description: '', due_date: '' }); 
            notify('Task added successfully!');
            setModalOpen(false);
        } catch (error) {
            console.error('Error adding task', error);
            notify('Failed to add task.', 'error');
        }
    };

    const handleEditTask = async () => {
        if (!editTask.title || !editTask.description || !editTask.due_date) {
            notify('All fields are required!', 'error');
            return;
        }
        try {
            const response = await axios.put(`/api/tasks/${editTask.id}`, editTask, {
                headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
            });
            setTasks(tasks.map(task => (task.id === editTask.id ? response.data : task)));
            setEditTask(null);
            notify('Task updated successfully!');
        } catch (error) {
            console.error('Error editing task', error);
            notify('Failed to edit task.', 'error');
        }
    };

    const handleDeleteTask = async (id) => {
        try {
            await axios.delete(`/api/tasks/${id}`, {
                headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
            });
            setTasks(tasks.filter(task => task.id !== id));
            setDeleteModal({ open: false, taskId: null });
            notify('Task deleted successfully!');
        } catch (error) {
            console.error('Error deleting task', error);
            notify('Failed to delete task.', 'error');
        }
    };

    const setChangeTaskStatus = async (taskId, currentStatus) => {
        try {
            const newStatus = currentStatus === 'pending' ? 'completed' : 'pending';
            const response = await axios.patch(`/api/tasks/${taskId}/status`, { status: newStatus }, {
                headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
            });
    
            // Update the task list with the new status
            setTasks(prevTasks =>
                prevTasks.map(task =>
                    task.id === taskId ? { ...task, status: response.data.status } : task
                )
            );
            notify(`Task status updated to ${newStatus}!`);
        } catch (error) {
            console.error('Error updating task status', error);
            notify('Failed to update task status.', 'error');
        }
    };
   

   

    const handlePageChange = (page) => {
        if (page >= 1 && page <= totalPages) {
            setCurrentPage(page);
        }
    };

    const handleFilterChange = (status) => {
        setFilter(status); 
        setCurrentPage(1); 
    };
    const handleSearchChange = (e) => {
        setSearchQuery(e.target.value);
        setCurrentPage(1); 
    };

     
     useEffect(() => {
        fetchTasks(currentPage, filter,searchQuery);
    }, [currentPage, filter,searchQuery]);
    
    

    if (loading) return <div className="text-center">Loading...</div>;

    return (
        <div className="bg-white p-6 rounded shadow">
            <h1 className="text-2xl font-bold mb-4">Task Dashboard</h1>

            <Notification notification={notification} />

            <div className="flex justify-between mb-4">
                <div>
                    <button
                        onClick={() => handleFilterChange('all')}
                        className={`px-4 py-2 rounded ${filter === 'all' ? 'bg-blue-500 text-white' : 'bg-gray-200'}`}
                    >
                        All
                    </button>
                    <button
                        onClick={() => handleFilterChange('pending')}
                        className={`ml-2 px-4 py-2 rounded ${filter === 'pending' ? 'bg-blue-500 text-white' : 'bg-gray-200'}`}
                    >
                        Pending
                    </button>
                    <button
                        onClick={() => handleFilterChange('completed')}
                        className={`ml-2 px-4 py-2 rounded ${filter === 'completed' ? 'bg-blue-500 text-white' : 'bg-gray-200'}`}
                    >
                        Completed
                    </button>
                </div>
                <form onSubmit={(e) => e.preventDefault()}>
                    <input
                        type="text"
                        placeholder="Search tasks..."
                        value={searchQuery}
                        onChange={handleSearchChange}
                        className="border px-3 py-2 rounded"
                    />
                </form>
            </div>

            <button
                onClick={() => setModalOpen(true)}
                className="bg-green-500 text-white px-4 py-2 rounded mb-4"
            >
                Add Task
            </button>

            <TaskList
                tasks={tasks}
                setEditTask={setEditTask}
                setDeleteModal={setDeleteModal}
                setChangeTaskStatus={setChangeTaskStatus}
            />

            <div className="flex justify-center items-center mt-4 space-x-2">
                <button
                    onClick={() => handlePageChange(currentPage - 1)}
                    disabled={currentPage === 1}
                    className="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded disabled:opacity-50"
                >
                    Previous
                </button>
                {[...Array(totalPages)].map((_, index) => (
                    <button
                        key={index}
                        onClick={() => handlePageChange(index + 1)}
                        className={`px-3 py-1 rounded ${
                            currentPage === index + 1
                                ? 'bg-blue-500 text-white'
                                : 'bg-gray-200 hover:bg-gray-300 text-gray-800'
                        }`}
                    >
                        {index + 1}
                    </button>
                ))}
                <button
                    onClick={() => handlePageChange(currentPage + 1)}
                    disabled={currentPage === totalPages}
                    className="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded disabled:opacity-50"
                >
                    Next
                </button>
            </div>

            <AddTaskModal
                modalOpen={modalOpen}
                setModalOpen={setModalOpen}
                newTask={newTask}
                setNewTask={setNewTask}
                handleAddTask={handleAddTask}
            />

            <EditTaskModal
                editTask={editTask}
                setEditTask={setEditTask}
                handleEditTask={handleEditTask}
            />

            <DeleteTaskModal
                deleteModal={deleteModal}
                setDeleteModal={setDeleteModal}
                handleDeleteTask={handleDeleteTask}
            />
        </div>
    );
}


        ReactDOM.render(<TaskDashboard />, document.getElementById('task-dashboard'));