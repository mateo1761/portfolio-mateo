<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import type { Experience } from '@/types';

const props = defineProps<{
    errors: Record<string, string>;
    experience?: Experience;
}>();

const groups = [
    {
        label: 'Spanish content',
        fields: [
            { name: 'role_es', label: 'Role', multiline: false },
            { name: 'period_es', label: 'Period', multiline: false },
            { name: 'location_es', label: 'Location', multiline: false },
            { name: 'summary_es', label: 'Summary', multiline: true },
        ],
    },
    {
        label: 'English content',
        fields: [
            { name: 'role_en', label: 'Role', multiline: false },
            { name: 'period_en', label: 'Period', multiline: false },
            { name: 'location_en', label: 'Location', multiline: false },
            { name: 'summary_en', label: 'Summary', multiline: true },
        ],
    },
] as const;

const value = (field: keyof Experience): string | number | undefined => {
    const fieldValue = props.experience?.[field];

    return typeof fieldValue === 'boolean' ? undefined : fieldValue;
};
</script>

<template>
    <div class="grid gap-6">
        <fieldset
            class="grid gap-5 rounded-xl border border-portfolio-divider bg-portfolio-surface p-5 sm:p-7"
        >
            <legend
                class="px-2 text-sm font-semibold tracking-[0.12em] text-portfolio-gold uppercase"
            >
                Shared information
            </legend>
            <div class="grid gap-2">
                <Label for="company">Company</Label>
                <Input
                    id="company"
                    name="company"
                    :default-value="experience?.company"
                    required
                    maxlength="255"
                />
                <InputError :message="errors.company" />
            </div>
        </fieldset>

        <fieldset
            v-for="group in groups"
            :key="group.label"
            class="grid gap-5 rounded-xl border border-portfolio-divider bg-portfolio-surface p-5 sm:p-7"
        >
            <legend
                class="px-2 text-sm font-semibold tracking-[0.12em] text-portfolio-gold uppercase"
            >
                {{ group.label }}
            </legend>
            <div
                v-for="field in group.fields"
                :key="field.name"
                class="grid gap-2"
            >
                <Label :for="field.name">{{ field.label }}</Label>
                <textarea
                    v-if="field.multiline"
                    :id="field.name"
                    :name="field.name"
                    :value="value(field.name)"
                    required
                    maxlength="5000"
                    rows="5"
                    class="min-h-28 w-full rounded-md border border-portfolio-divider bg-portfolio-background/55 px-3 py-2 text-sm text-portfolio-text outline-none focus-visible:border-portfolio-gold focus-visible:ring-3 focus-visible:ring-portfolio-gold/25"
                />
                <Input
                    v-else
                    :id="field.name"
                    :name="field.name"
                    :default-value="value(field.name)"
                    required
                    maxlength="255"
                />
                <InputError :message="errors[field.name]" />
            </div>
        </fieldset>

        <fieldset
            class="grid gap-5 rounded-xl border border-portfolio-divider bg-portfolio-surface p-5 sm:p-7"
        >
            <legend
                class="px-2 text-sm font-semibold tracking-[0.12em] text-portfolio-gold uppercase"
            >
                Publication
            </legend>
            <div class="grid max-w-40 gap-2">
                <Label for="sort_order">Sort order</Label>
                <Input
                    id="sort_order"
                    name="sort_order"
                    type="number"
                    min="0"
                    max="32767"
                    :default-value="experience?.sort_order ?? 0"
                    required
                />
                <InputError :message="errors.sort_order" />
            </div>
            <input type="hidden" name="is_published" value="0" />
            <label class="flex items-start gap-3 text-sm" for="is_published">
                <input
                    id="is_published"
                    name="is_published"
                    type="checkbox"
                    value="1"
                    :checked="experience?.is_published ?? false"
                    class="mt-0.5 size-4 rounded border border-input focus-visible:ring-2 focus-visible:ring-ring"
                />
                <span
                    ><span class="block font-medium">Published</span
                    ><span class="text-portfolio-muted"
                        >Show this experience on the public portfolio.</span
                    ></span
                >
            </label>
            <InputError :message="errors.is_published" />
        </fieldset>
    </div>
</template>
