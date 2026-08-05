<script setup lang="ts">
import { Form } from '@inertiajs/vue3';
import { Trash2 } from '@lucide/vue';
import { destroy } from '@/actions/App/Http/Controllers/ExperienceController';
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
import type { Experience } from '@/types';

defineProps<{ experience: Experience }>();
</script>

<template>
    <Dialog>
        <DialogTrigger as-child
            ><Button variant="destructive" size="sm" type="button"
                ><Trash2 />Delete</Button
            ></DialogTrigger
        >
        <DialogContent
            class="border-portfolio-divider bg-portfolio-surface text-portfolio-text"
        >
            <Form
                v-bind="destroy.form(experience.id)"
                class="grid gap-6"
                v-slot="{ processing }"
            >
                <DialogHeader class="gap-3">
                    <DialogTitle>Delete experience?</DialogTitle>
                    <DialogDescription class="text-portfolio-muted"
                        >The {{ experience.role_en }} position at
                        {{ experience.company }} will be removed permanently
                        from the administration panel and public
                        portfolio.</DialogDescription
                    >
                </DialogHeader>
                <DialogFooter class="gap-2">
                    <DialogClose as-child
                        ><Button type="button" variant="secondary"
                            >Keep experience</Button
                        ></DialogClose
                    >
                    <Button
                        type="submit"
                        variant="destructive"
                        :disabled="processing"
                        >{{
                            processing ? 'Deleting…' : 'Delete permanently'
                        }}</Button
                    >
                </DialogFooter>
            </Form>
        </DialogContent>
    </Dialog>
</template>
