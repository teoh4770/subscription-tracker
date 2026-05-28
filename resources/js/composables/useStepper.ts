import {ref} from "vue";

export function useStepper() {
    const currentStep = ref(0);
    function nextStep() {
        currentStep.value = currentStep.value + 1;
    }
    function previousStep() {
        currentStep.value = Math.max(currentStep.value - 1, 0);
    }

    return {
        currentStep,
        nextStep,
        previousStep
    };
}
