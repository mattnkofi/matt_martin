<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System | User Data</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Century Gothic', sans-serif;
            background-color: #000000;
            color: #ffffff;
        }

        .bg-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            pointer-events: none;
            z-index: 1;
        }

        table {
            table-layout: fixed;
            width: 100%;
        }

        .white-shadow {
            box-shadow: 0 4px 6px -1px rgba(255, 255, 255, 0.1), 0 2px 4px -1px rgba(255, 255, 255, 0.06);
        }

        .text-shadow {
            text-shadow: 2px 2px 4px rgba(255, 255, 255, 0.3);
        }

        .disabled-link {
            pointer-events: none;
        }
        /* Custom hover for a softer look */
        .soft-hover:hover {
            background-color: #1a1a1a; /* Darker grey for a soft background contrast */
            color: #f0f0f0; /* Slightly off-white for softer text contrast */
        }
    </style>
</head>

<body class="min-h-screen relative bg-cover bg-center" style="background-image: url('<?php echo base_url(); ?>/cfbg2.png');">
    <div class="bg-overlay"></div>

    <section class="min-h-screen relative z-20 flex flex-col items-center p-6 sm:p-12 shadow-lg white-shadow">

        <h1 class="text-3xl sm:text-4xl font-extrabold text-white text-center text-shadow mb-12">Students List</h1>

        <div class="w-full flex justify-between items-center mb-12">
            <div class="flex gap-4">
                <a href="#" onclick="history.back()" class="bg-black text-white p-4 rounded-full shadow-lg white-shadow hover:bg-white hover:text-black transition duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <a href="<?= site_url('/'); ?>" class="bg-black text-white p-4 rounded-full shadow-lg white-shadow hover:bg-white hover:text-black transition duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </a>
            </div>

            <form method="GET" action="<?= site_url('users/show'); ?>" class="relative w-1/3 min-w-[200px] shadow-lg white-shadow">
                <input type="hidden" name="page" value="1"> <input type="text" name="q" id="searchInput" placeholder="Search" value="<?= htmlspecialchars($search ?? ''); ?>" class="w-full bg-black text-white rounded-full px-6 py-3 border border-white focus:outline-none focus:ring-1 focus:ring-gray transition duration-300 ease-in-out">
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </form>
        </div>

        <div class="w-full overflow-x-auto shadow-lg rounded-lg white-shadow">
            <table class="min-w-full text-white rounded-lg overflow-hidden">
                <thead class="bg-black border-b border-white">
                    <tr>
                        <th class="px-4 py-3 text-left uppercase text-sm font-semibold">ID</th>
                        <th class="px-4 py-3 text-left uppercase text-sm font-semibold">Profile</th>
                        <th class="px-4 py-3 text-left uppercase text-sm font-semibold">Last Name</th>
                        <th class="px-4 py-3 text-left uppercase text-sm font-semibold">First Name</th>
                        <th class="px-4 py-3 text-left uppercase text-sm font-semibold">Email</th>
                        <th class="px-4 py-3 text-left uppercase text-sm font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-black divide-y divide-white" id="userTableBody">
                    <?php
                    if (empty($users)) {
                        // REPLACED hover:bg-white hover:text-black with soft-hover
                        echo '<tr class="soft-hover transition-colors duration-300"><td colspan="6" class="py-4 text-center text-white">No users found.</td></tr>';
                    } else {
                        foreach (html_escape($users) as $user):
                    ?>
                            <tr class="soft-hover transition-colors duration-300 ease-in-out">
                                <td class="px-4 py-3"><?= $user['id']; ?></td>
                                <td class="px-4 py-3"><span class="text-sm text-white">(IMAGE)</span></td>
                                <td class="px-4 py-3"><?= $user['last_name']; ?></td>
                                <td class="px-4 py-3"><?= $user['first_name']; ?></td>
                                <td class="px-4 py-3"><?= $user['email']; ?></td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-2">
                                        <a href="<?= site_url('users/update/' . $user['id']); ?>" class="text-white hover:text-black p-2 rounded-md transition-colors duration-300 hover:bg-white" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        
                                        <button type="button" onclick="openDeleteModal('<?= site_url('users/delete/' . $user['id']); ?>')" class="text-white hover:text-black p-2 rounded-md transition-colors duration-300 hover:bg-white" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 10-2 0v6a1 1 0 102 0V8z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        endforeach;
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php
        // Server-side pagination (functional links, preserves search; no UI change)
        $search_param = !empty($search) ? '&q=' . urlencode($search) : '';
        $is_first_disabled = ($current_page == 1);
        $is_last_disabled = ($current_page >= $total_pages);
        ?>
        <div class="mt-8 flex justify-center items-center gap-4">
            <a href="<?= site_url('users/show?page=1' . $search_param); ?>" 
               class="px-6 py-3 bg-black text-white rounded-lg shadow-lg white-shadow hover:bg-white hover:text-black transition duration-300 ease-in-out <?= $is_first_disabled ? 'opacity-50 cursor-not-allowed disabled-link' : ''; ?>">
                FIRST
            </a>
            <a href="<?= site_url('users/show?page=' . max(1, $current_page - 1) . $search_param); ?>" 
               class="px-4 py-3 bg-black text-white rounded-lg shadow-lg white-shadow hover:bg-white hover:text-black transition duration-300 ease-in-out <?= $is_first_disabled ? 'opacity-50 cursor-not-allowed disabled-link' : ''; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <span class="px-6 py-3 bg-white text-black rounded-lg shadow-lg white-shadow"><?= $current_page; ?> of <?= $total_pages; ?></span>
            <a href="<?= site_url('users/show?page=' . min($total_pages, $current_page + 1) . $search_param); ?>" 
               class="px-4 py-3 bg-black text-white rounded-lg shadow-lg white-shadow hover:bg-white hover:text-black transition duration-300 ease-in-out <?= $is_last_disabled ? 'opacity-50 cursor-not-allowed disabled-link' : ''; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            <a href="<?= site_url('users/show?page=' . $total_pages . $search_param); ?>" 
               class="px-6 py-3 bg-black text-white rounded-lg shadow-lg white-shadow hover:bg-white hover:text-black transition duration-300 ease-in-out <?= $is_last_disabled ? 'opacity-50 cursor-not-allowed disabled-link' : ''; ?>">
                LAST
            </a>
        </div>
    </section>

    <div id="deleteModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-black text-white p-6 rounded-lg w-80 text-center shadow-lg white-shadow">
            <h2 class="text-lg font-bold mb-4">Confirm Deletion</h2>
            <p class="mb-6">Are you sure you want to delete this user?</p>
            <div class="flex justify-center gap-4">
                <a id="confirmDeleteBtn" href="#" class="px-4 py-2 bg-white text-black rounded-md font-semibold shadow-lg hover:bg-gray-200 transition duration-300 ease-in-out">Yes, Delete</a>
                <button onclick="closeDeleteModal()" class="px-4 py-2 bg-black text-white rounded-md font-semibold shadow-lg hover:bg-white hover:text-black transition duration-300 ease-in-out">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        // Modal functions only (removed client-side search/pagination for server-side)
        function openDeleteModal(url) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('confirmDeleteBtn').href = url;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</body>

</html>