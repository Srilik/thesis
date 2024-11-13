<script setup lang="ts">
import type { PropType } from "vue";
import { ref, onMounted, computed } from "vue";
import ErrorLabel from "@/Components/ErrorLabel.vue";
import BreezeLabel from "@/Components/BreezeLabel.vue";

const props = defineProps({
    // modelValue: {
    //   // any type
    //   required: true,
    // },
    error: {
        type: String as PropType<string>,
        required: false,
    },
    label: {
        type: String as PropType<string>,
        required: false,
    },
    options: {
        type: Array,
        required: false,
    },
    trackBy: {
        type: String,
        required: false,
    },
    labelBy: {
        type: String,
        required: false,
    },
});

const modelValue = defineModel();

const select = ref(null);
const label = ref(props.label);
const divWrapper = ref(null);
onMounted(() => {
    if (select.value.hasAttribute("autofocus")) {
        select.value.focus();
    }
    if (select.value.hasAttribute("required")) {
        label.value = label.value + `<span class="text-red-500">*</span>`;
    }
    // remove all attributes from divWrapper except for class
    divWrapper.value.removeAttribute("tabindex");
    divWrapper.value.removeAttribute("id");
});
const optionsComputed = computed(() => {
    return props.options?.map((option: any) => {
        return {
            value: props.trackBy ? option[props.trackBy] : option,
            label: props.labelBy ? option[props.labelBy] : option,
        };
    });
});
// const optionsComputed = computed(() => {
//   let options = props.options;
//
//   let newOptions = [];
//
//   if (props.trackBy && props.labelBy) {
//     newOptions = options.map((option: any) => {
//       return {
//         value: option[props.trackBy],
//         label: option[props.labelBy],
//       };
//     });
//   }
//
//   if (props.trackBy && !props.labelBy) {
//     newOptions = options.map((option: any) => {
//       return {
//         value: option[props.trackBy],
//         label: option,
//       };
//     });
//   }
//
//   if (!props.trackBy && props.labelBy) {
//     newOptions = options.map((option: any) => {
//       return {
//         value: option,
//         label: option[props.labelBy],
//       };
//     });
//   }
//
//   if (!props.trackBy && !props.labelBy) {
//     newOptions = options.map((option: any) => {
//       return {
//         value: option,
//         label: option,
//       };
//     });
//   }
//
//   return newOptions;
// });
</script>
<template>
    <div ref="divWrapper" class="w-full">
        <BreezeLabel v-if="label" class="mb-2">
            <span v-html="label" />
        </BreezeLabel>
        <select
            v-bind="$attrs"
            ref="select"
            v-model="modelValue"
            class="w-full input input-primary"
        >
            <option
                v-if="optionsComputed.length > 0"
                v-for="option in optionsComputed"
                :key="option.value"
                :value="option.value"
            >
                {{ option.label }}
            </option>
        </select>
        <ErrorLabel v-if="error" :error="error" class="mb-3" />
    </div>
</template>
