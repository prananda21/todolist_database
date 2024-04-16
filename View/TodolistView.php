<?php

namespace View {

    use Service\TodolistService;
    use Helper\InputHelper;

    class TodolistView {

        private TodolistService $todolistService;

        public function __construct(TodolistService $todolistService) {
            $this->todolistService=$todolistService;
        }

        function showTodoList(): void 
        {
            while (true) {
                $this->todolistService->showTodoList();
            
                echo "Menu" . PHP_EOL;
                echo "1. Tambah Todo". PHP_EOL;
                echo "2. Hapus Todo". PHP_EOL;
                echo "X. Keluar". PHP_EOL;
            
                $pilihan = InputHelper::input("Pilih");
                if( $pilihan == "1") {
                    $this->addTodoList() ;
                } elseif ( $pilihan == "2") {
                    $this->removeTodoList() ;
                } elseif ( $pilihan == "X") {
                    break;
                } else {
                    echo "Pilihan tidak dimengerti". PHP_EOL;
                }
            }
        
            echo "Sampai Jumpa Lagi" . PHP_EOL;
        }

        function addTodoList(): void 
        {
            echo "Menambah Todo" . PHP_EOL;

            $todo = InputHelper::input("Todo (X untuk batal)");
        
            if($todo == "X") {
                echo "Batal menambah Todo". PHP_EOL;
            } else {
                $this->todolistService->addTodolist($todo);
            }
        }

        function removeTodoList(): void 
        {
            echo "MENGHAPUS TODO" . PHP_EOL;

            $pilihan  = InputHelper::input("Nomor (X untuk batalkan)");
        
            if ($pilihan == "X") {
                echo "Batal menghapus Todo". PHP_EOL;
            } else {
                $this->todolistService->removeTodolist($pilihan);
            }
        }
    }
}