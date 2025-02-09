<template>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-6">
        <h1 class="text-xl font-bold text-gray-800 text-center">
            Periodic Table of Elements Quiz
        </h1>
        <p class="mt-4 text-md text-gray-600 text-center">
            Select a game type to continue. Can you guess them all correct?
        </p>


        <div class="mt-6">
            <label class="block text-gray-700 text-sm font-medium mb-2">
                Select Number of Questions
            </label>

            <Dropdown align="left" width="48">
                <template #trigger>
                    <button class="w-48 p-2 border border-gray-300 rounded-md bg-white text-gray-700 text-left">
                        {{ selectedOption }}
                        <span class="float-right">▼</span>
                    </button>
                </template>

                <template #content>
                    <div class="bg-white rounded-md shadow-md py-1">
                        <button
                            v-for="option in options"
                            :key="option"
                            class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-200"
                            @click="selectOption(option)"
                        >
                            {{ option }}
                        </button>
                    </div>
                </template>
            </Dropdown>
        </div>

        <!-- Start Button -->
        <PrimaryButton :href="computedHref">
            Start
        </PrimaryButton>
    </div>
</template>

<script setup>
import {computed, ref} from "vue";
import Dropdown from "@/Components/Dropdown.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const selectedOption = ref("10");
const options = ["10", "25", "50", "all"];

// Function to update selected option and close dropdown
const selectOption = (option) => {
    selectedOption.value = option;
};

const computedHref = computed(() => `/play?number=${selectedOption.value}`);

// Handle start button click

</script>
