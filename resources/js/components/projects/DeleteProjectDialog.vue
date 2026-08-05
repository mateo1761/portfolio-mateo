<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { Trash2 } from '@lucide/vue';
import { destroy } from '@/actions/App/Http/Controllers/ProjectController';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import type { Project } from '@/types';

defineProps<{
    project: Project;
}>();
</script>

<template>
    <Dialog>
        <DialogTrigger as-child>
            <Button variant="destructive" size="sm" type="button">
                <Trash2 aria-hidden="true" />
                Delete
            </Button>
        </DialogTrigger>

        <DialogContent
            class="border-portfolio-divider bg-portfolio-surface text-portfolio-text"
        >
            <Form
                v-bind="destroy.form(project.id)"
                class="grid gap-6"
                v-slot="{ processing }"
            >
                <DialogHeader class="gap-3">
                    <DialogTitle>Delete project?</DialogTitle>
                    <DialogDescription class="text-portfolio-muted">
                        “{{ project.title_es }}” will be removed permanently
                        from the administration panel and the public portfolio.
                        This action cannot be undone.
                    </DialogDescription>
                </DialogHeader>

                <DialogFooter class="gap-2">
                    <DialogClose as-child>
                        <Button type="button" variant="secondary">
                            Keep project
                        </Button>
                    </DialogClose>
                    <Button
                        type="submit"
                        variant="destructive"
                        :disabled="processing"
                    >
                        {{ processing ? 'Deleting…' : 'Delete permanently' }}
                    </Button>
                </DialogFooter>
            </Form>
        </DialogContent>
    </Dialog>
</template>
