<template>
    <div class="flex flex-col gap-4 items-center justify-center min-h-screen bg-gray-900 ">
        <!-- Element Card -->
        <div
            class="text-white"
        >{{ currentIndex + 1 }} / {{ elements.length }}
        </div>
        <div
            class="w-40 h-48 bg-gray-800 rounded-lg shadow-lg flex flex-col items-center justify-center text-center p-4">
            <h2 class="text-4xl font-bold text-white">{{ elements[currentIndex].symbol }}</h2>
            <p class="text-sm text-gray-400">Atomic Number: {{ elements[currentIndex].atomic_number }}</p>
            <p class="text-sm text-gray-400">Atomic Mass: {{ elements[currentIndex].atomic_mass }}</p>
        </div>


        <TextInput v-model="userGuess"
                   :disabled="guessMade"
                   placeholder="Enter element name..."
                   type="text">

        </TextInput>


        <PrimaryButton :disabled="guessMade"
                       @click="checkGuess">
            Submit
        </PrimaryButton>

        <!-- Feedback Message -->
        <p v-if="feedbackMessage" class="mt-2 text-lg font-semibold">{{ feedbackMessage }}</p>

        <!-- Next Button (Appears only after guessing) -->
        <button
            v-if="guessMade"
            class="mt-2 bg-green-500 hover:bg-green-600  font-bold py-2 px-4 rounded"
            @click="nextElement"
        >
            Next
        </button>

    </div>
</template>

<script setup>
import {ref} from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    elements: Array
});

const currentQuestion = ref(0);

const elements = ref([...props.elements]);

const currentIndex = ref(0);
const userGuess = ref("");
const guessMade = ref(false);
const feedbackMessage = ref("");

const checkGuess = () => {
    const correctAnswer = elements.value[currentIndex.value].name.toLowerCase();
    const userAnswer = userGuess.value.trim().toLowerCase();

    if (userAnswer === correctAnswer) {
        feedbackMessage.value = "✅ Correct!";
    } else {
        feedbackMessage.value = `❌ Wrong! The correct answer was ${elements.value[currentIndex.value].name}.`;
    }

    guessMade.value = true;
};

const nextElement = () => {
    if (currentIndex.value < elements.value.length - 1) {
        currentIndex.value++;
        userGuess.value = "";
        guessMade.value = false;
        feedbackMessage.value = "";
    } else {
        feedbackMessage.value = "🎉 Game Over! Refresh to play again.";
    }
};
</script>
