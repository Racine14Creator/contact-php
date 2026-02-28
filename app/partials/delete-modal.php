<div id="deleteModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded shadow-lg w-96 p-6">
        <h2 class="text-lg font-semibold mb-4">Confirm Delete</h2>
        <p>Are you sure you want to delete this contact?</p>
        <div class="mt-6 flex justify-end space-x-2">
            <button id="cancelBtn" onclick="hideModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
            <a id="confirmDelete" href="#" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete</a>
        </div>
    </div>
</div>