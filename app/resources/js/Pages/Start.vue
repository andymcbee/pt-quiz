<template>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-6">
        <h1 class="text-xl font-bold text-gray-800 text-center">
            Periodic Table of Elements Quiz
        </h1>
        <p class="mt-4 text-md text-gray-600 text-center">
            Select a game type to continue. Can you guess them all correct?
        </p>

        <!-- Dropdown -->
        <div class="mt-6">
            <label class="block text-gray-700 text-sm font-medium mb-2" for="game-type">
                Select Number of Questions
            </label>
            <select
                id="game-type"
                v-model="selectedOption"
                class="w-48 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
            >
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="all">All</option>
            </select>
        </div>

        <!-- Start Button -->
        <button
            class="mt-6 px-6 py-3 bg-blue-600 text-white text-lg font-semibold rounded-md hover:bg-blue-700 transition duration-200"
            @click="startGame"
        >
            Start
        </button>
    </div>
</template>

<script setup>
import {ref} from "vue";

// Selected option state
const selectedOption = ref("10");

// Handle start button click
const startGame = () => {
    alert(`Starting the game with ${selectedOption.value} questions!`);
    // Here you can navigate to the quiz page or update the game state
};
</script>
