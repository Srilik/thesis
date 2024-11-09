<script setup lang="ts">
import { cn } from "@/lib/utils";
import { Button } from "@/Components/ui/button";
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from "@/Components/ui/popover";
import {
    Combobox,
    ComboboxInput,
    ComboboxOption,
    ComboboxOptions,
    TransitionRoot,
} from "@headlessui/vue";
import { Check, ChevronsUpDown, X } from "lucide-vue-next";
import type { HTMLAttributes } from "vue";
import { computed, onMounted, ref } from "vue";

export interface Props {
    options?: {
        label?: string | number | undefined;
        value: string | number | object;
        unavailable?: boolean;
    }[];
    class?: HTMLAttributes["class"];
    placeholder?: HTMLAttributes["placeholder"];
    multiple?: boolean;
    closeOnSelect?: boolean;
    clearOnSelect?: boolean;
    taggable?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    closeOnSelect: true,
});

const emit = defineEmits<{
    (e: "tag", value: string): void;
}>();

const model = defineModel<string | number | object | [] | null>();
const query = ref("");

const filteredOptions = computed(() => {
    if (query.value) {
        return props?.options?.filter(
            (item) =>
                item.label
                    .toString()
                    ?.toLowerCase()
                    .replace(/\s+/g, "")
                    .includes(
                        query.value
                            ?.toString()
                            ?.toLowerCase()
                            .replace(/\s+/g, ""),
                    ),
        );
    }
    return props.options;
});

const open = ref(false);
const labelComputed = computed(() => {
    if (props.multiple) {
        const modelMultiple = model.value as string[];
        return modelMultiple?.map((item) => {
            return props.options?.find((option) => option.value === item)
                ?.label;
        });
    }
    return props.options?.find((item) => item.value === model.value)?.label;
}) as any;

onMounted(() => {
    // listen for for escape key to close the popover
    window.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
            open.value = false;
        }
    });
});

const onUpdateValue = () => {
    if (props.closeOnSelect) {
        open.value = false;
    }
    if (props.clearOnSelect) {
        query.value = "";
    }
};

const onTag = (value: string) => {
    emit("tag", value);
};
</script>
<template>
    <Popover v-model:open="open">
        <PopoverTrigger as-child>
            <Button
                type="button"
                role="combobox"
                :aria-expanded="open"
                size="lg"
                variant="outline"
                :class="
                    cn(
                        'w-full min-h-10 h-auto px-2 justify-between',
                        props.class,
                    )
                "
            >
                <div v-if="multiple" class="flex flex-wrap gap-0.5 w-full">
                    <span
                        v-for="label in labelComputed"
                        :key="label"
                        class="flex items-center gap-1 rounded-md badge badge-primary"
                    >
                        <span>{{ label }}</span>
                        <button
                            type="button"
                            variant="outline"
                            class="p-0.5 h-5 w-5"
                            @click="
                                model = (model as string[])?.filter(
                                    (item) => item !== label,
                                )
                            "
                        >
                            <X class="w-4 h-4" />
                        </button>
                    </span>
                    <span v-if="labelComputed?.length === 0">
                        {{ placeholder || "Select items..." }}
                    </span>
                </div>

                <span v-else class="w-full">
                    {{ labelComputed || placeholder || "Select item..." }}
                </span>
                <ChevronsUpDown class="w-4 h-4 ml-2 opacity-50 shrink-0" />
            </Button>
        </PopoverTrigger>
        <PopoverContent class="p-0 z-[10000]">
            <Combobox
                v-model="model"
                as="div"
                class="flex flex-col w-full h-full overflow-hidden rounded-md bg-popover text-popover-foreground"
                :multiple="multiple"
                @update:modelValue="onUpdateValue"
            >
                <ComboboxInput
                    class="'flex m-2 h-10 w-auto rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50',"
                    :display-value="() => query"
                    as="input"
                    placeholder="Search..."
                    @change="query = $event.target.value"
                />

                <template v-if="taggable && query">
                    <button
                        class="relative flex items-center rounded-sm px-2 py-1.5 text-sm bg-green-100 dark:bg-green-800 w-full justify-between mx-1"
                        type="button"
                        @click="onTag(query)"
                    >
                        <span>{{ query }}</span>
                        Add New
                    </button>
                </template>

                <TransitionRoot
                    leave="transition ease-in duration-100"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                    :show="open"
                    @after-leave="query = ''"
                >
                    <div
                        class="max-h-[300px] overflow-y-auto overflow-x-hidden"
                    >
                        <div role="presentation">
                            <ComboboxOptions
                                class="p-1 overflow-hidden text-foreground"
                                as="div"
                            >
                                <div
                                    v-if="
                                        filteredOptions.length === 0 &&
                                        query !== ''
                                    "
                                    class="relative px-4 py-2 text-sm text-gray-700 cursor-default select-none"
                                >
                                    Nothing found.
                                </div>

                                <ComboboxOption
                                    v-for="option in filteredOptions"
                                    :key="option.value?.toString()"
                                    v-slot="{ selected, active }"
                                    :value="option.value"
                                    :disabled="option.unavailable"
                                    as="template"
                                >
                                    <div
                                        class="relative flex cursor-default select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none"
                                        :class="{
                                            'bg-base-200': active,
                                            'pointer-events-none opacity-50':
                                                option.unavailable,
                                        }"
                                    >
                                        {{ option.label }}
                                        <Check
                                            :class="
                                                cn(
                                                    'ml-auto h-4 w-4',
                                                    selected
                                                        ? 'opacity-100'
                                                        : 'opacity-0',
                                                )
                                            "
                                        />
                                    </div>
                                </ComboboxOption>
                            </ComboboxOptions>
                        </div>
                    </div>
                </TransitionRoot>
            </Combobox>
        </PopoverContent>
    </Popover>
</template>
