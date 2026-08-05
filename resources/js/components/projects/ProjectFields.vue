<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import type { Project } from '@/types';

defineProps<{
    errors: Record<string, string>;
    project?: Project;
}>();
</script>

<template>
    <div class="grid gap-6">
        <fieldset
            class="grid gap-5 rounded-xl border border-portfolio-divider bg-portfolio-surface p-5 sm:p-7"
        >
            <legend
                class="px-2 text-sm font-semibold tracking-[0.12em] text-portfolio-gold uppercase"
            >
                Spanish content
            </legend>

            <div class="grid gap-2">
                <Label for="title_es">Title</Label>
                <Input
                    id="title_es"
                    name="title_es"
                    :default-value="project?.title_es"
                    required
                    maxlength="255"
                />
                <InputError :message="errors.title_es" />
            </div>

            <div class="grid gap-2">
                <Label for="category_es">Category</Label>
                <Input
                    id="category_es"
                    name="category_es"
                    :default-value="project?.category_es"
                    required
                    maxlength="255"
                />
                <InputError :message="errors.category_es" />
            </div>

            <div class="grid gap-2">
                <Label for="description_es">Description</Label>
                <textarea
                    id="description_es"
                    name="description_es"
                    :value="project?.description_es"
                    required
                    maxlength="5000"
                    rows="5"
                    class="min-h-28 w-full rounded-md border border-portfolio-divider bg-portfolio-background/55 px-3 py-2 text-sm text-portfolio-text shadow-xs outline-none placeholder:text-portfolio-muted focus-visible:border-portfolio-gold focus-visible:ring-3 focus-visible:ring-portfolio-gold/25"
                />
                <InputError :message="errors.description_es" />
            </div>

            <div class="grid gap-2">
                <Label for="technologies_es">Technologies</Label>
                <Input
                    id="technologies_es"
                    name="technologies_es"
                    :default-value="project?.technologies_es"
                    required
                    maxlength="255"
                />
                <InputError :message="errors.technologies_es" />
            </div>
        </fieldset>

        <fieldset
            class="grid gap-5 rounded-xl border border-portfolio-divider bg-portfolio-surface p-5 sm:p-7"
        >
            <legend
                class="px-2 text-sm font-semibold tracking-[0.12em] text-portfolio-gold uppercase"
            >
                English content
            </legend>

            <div class="grid gap-2">
                <Label for="title_en">Title</Label>
                <Input
                    id="title_en"
                    name="title_en"
                    :default-value="project?.title_en"
                    required
                    maxlength="255"
                />
                <InputError :message="errors.title_en" />
            </div>

            <div class="grid gap-2">
                <Label for="category_en">Category</Label>
                <Input
                    id="category_en"
                    name="category_en"
                    :default-value="project?.category_en"
                    required
                    maxlength="255"
                />
                <InputError :message="errors.category_en" />
            </div>

            <div class="grid gap-2">
                <Label for="description_en">Description</Label>
                <textarea
                    id="description_en"
                    name="description_en"
                    :value="project?.description_en"
                    required
                    maxlength="5000"
                    rows="5"
                    class="min-h-28 w-full rounded-md border border-portfolio-divider bg-portfolio-background/55 px-3 py-2 text-sm text-portfolio-text shadow-xs outline-none placeholder:text-portfolio-muted focus-visible:border-portfolio-gold focus-visible:ring-3 focus-visible:ring-portfolio-gold/25"
                />
                <InputError :message="errors.description_en" />
            </div>

            <div class="grid gap-2">
                <Label for="technologies_en">Technologies</Label>
                <Input
                    id="technologies_en"
                    name="technologies_en"
                    :default-value="project?.technologies_en"
                    required
                    maxlength="255"
                />
                <InputError :message="errors.technologies_en" />
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

            <div class="grid gap-2">
                <Label for="repository_url">Repository URL</Label>
                <Input
                    id="repository_url"
                    name="repository_url"
                    type="url"
                    :default-value="project?.repository_url ?? ''"
                    maxlength="2048"
                    placeholder="https://github.com/..."
                />
                <InputError :message="errors.repository_url" />
            </div>

            <div class="grid max-w-40 gap-2">
                <Label for="sort_order">Sort order</Label>
                <Input
                    id="sort_order"
                    name="sort_order"
                    type="number"
                    min="0"
                    max="32767"
                    :default-value="project?.sort_order ?? 0"
                    required
                />
                <InputError :message="errors.sort_order" />
            </div>

            <div class="grid gap-3">
                <input type="hidden" name="is_private" value="0" />
                <label class="flex items-start gap-3 text-sm" for="is_private">
                    <input
                        id="is_private"
                        name="is_private"
                        type="checkbox"
                        value="1"
                        :checked="project?.is_private ?? true"
                        class="mt-0.5 size-4 rounded border border-input focus-visible:ring-2 focus-visible:ring-ring"
                    />
                    <span>
                        <span class="block font-medium">Private project</span>
                        <span class="text-muted-foreground">
                            Hide the repository link in the future public view.
                        </span>
                    </span>
                </label>
                <InputError :message="errors.is_private" />

                <input type="hidden" name="is_published" value="0" />
                <label
                    class="flex items-start gap-3 text-sm"
                    for="is_published"
                >
                    <input
                        id="is_published"
                        name="is_published"
                        type="checkbox"
                        value="1"
                        :checked="project?.is_published ?? false"
                        class="mt-0.5 size-4 rounded border border-input focus-visible:ring-2 focus-visible:ring-ring"
                    />
                    <span>
                        <span class="block font-medium">Published</span>
                        <span class="text-muted-foreground">
                            Marks the project as ready for a later public
                            integration.
                        </span>
                    </span>
                </label>
                <InputError :message="errors.is_published" />
            </div>
        </fieldset>
    </div>
</template>
