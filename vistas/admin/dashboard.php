<?php if(!defined('URL_BASE')) exit; $url_base = constant('URL_BASE'); ?>
<div class="flex flex-col md:flex-row gap-6 mt-4">
    <!-- Sidebar Admin -->
    <aside class="w-full md:w-64 shrink-0 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-4">
        <div class="p-4 border-b border-slate-100 dark:border-slate-700 mb-4">
            <h2 class="text-xl font-bold font-heading text-slate-900 dark:text-white">Admin Panel</h2>
        </div>
        <nav class="space-y-2">
            <a href="<?php echo $url_base; ?>admin/dashboard" class="flex items-center gap-3 px-4 py-3 bg-brand-gold/10 text-brand-darkgold font-medium rounded-xl">
                <i class="fa-solid fa-chart-pie w-5"></i> Resumen
            </a>
            <a href="<?php echo $url_base; ?>admin/usuarios" class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 font-medium rounded-xl transition-colors">
                <i class="fa-solid fa-users w-5"></i> Usuarios
            </a>
            <a href="<?php echo $url_base; ?>admin/universidades" class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 font-medium rounded-xl transition-colors">
                <i class="fa-solid fa-building-columns w-5"></i> Universidades
            </a>
            <a href="<?php echo $url_base; ?>admin/becas" class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 font-medium rounded-xl transition-colors">
                <i class="fa-solid fa-award w-5"></i> Becas
            </a>
            <a href="<?php echo $url_base; ?>admin/simulacros" class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 font-medium rounded-xl transition-colors">
                <i class="fa-solid fa-clipboard-list w-5"></i> Tests y Simulacros
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1">
        <header class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold font-heading text-slate-900 dark:text-white">Dashboard General</h1>
                <p class="text-slate-500 dark:text-slate-400">Resumen del sistema y métricas clave.</p>
            </div>
        </header>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-slate-500 dark:text-slate-400 font-medium">Usuarios Registrados</h3>
                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center"><i class="fa-solid fa-users"></i></div>
                </div>
                <p class="text-3xl font-bold text-slate-900 dark:text-white"><?php echo $totalUsuarios; ?></p>
            </div>
            
            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-slate-500 dark:text-slate-400 font-medium">Universidades</h3>
                    <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center"><i class="fa-solid fa-building-columns"></i></div>
                </div>
                <p class="text-3xl font-bold text-slate-900 dark:text-white"><?php echo $totalUniversidades; ?></p>
            </div>

            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-slate-500 dark:text-slate-400 font-medium">Becas Activas</h3>
                    <div class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center"><i class="fa-solid fa-award"></i></div>
                </div>
                <p class="text-3xl font-bold text-slate-900 dark:text-white"><?php echo $totalBecas; ?></p>
            </div>

            <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-slate-500 dark:text-slate-400 font-medium">Simulacros Creados</h3>
                    <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center"><i class="fa-solid fa-pencil"></i></div>
                </div>
                <p class="text-3xl font-bold text-slate-900 dark:text-white"><?php echo $totalSimulacros; ?></p>
            </div>
        </div>
        
        <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 p-6 rounded-2xl text-blue-800 dark:text-blue-300">
            <h3 class="font-bold text-lg mb-2"><i class="fa-solid fa-circle-info"></i> Bienvenido al Panel de Administración</h3>
            <p>Desde aquí puedes gestionar el contenido principal de la plataforma. Usa el menú lateral para acceder a la gestión de Usuarios, agregar Universidades/Becas y configurar los Tests Vocacionales y Simulacros.</p>
        </div>
    </main>
</div>
