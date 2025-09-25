<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

const props = defineProps({
    memoId: {
        type: Number,
        required: true,
    },
    memo: {
        type: Object,
        required: true,
    }
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: '메모 수정',
        href: `/dashboard/edit/${props.memoId}`,
    },
];

const form = useForm({
    content: props.memo?.content || '',
});

const submit = () => {
    if (!form.content.trim()) {
        form.setError('content', '메모 내용을 입력해주세요.');
        return;
    }

    form.put(`/dashboard/update/${props.memoId}`, {
        onSuccess: () => {
            window.location.href = '/dashboard';
        },
    });
};
</script>

<template>
    <Head title="메모 수정" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <Card class="max-w-2xl mx-auto">
                <CardHeader>
                    <CardTitle>메모 수정</CardTitle>
                </CardHeader>
                <CardContent>
                    <form @submit.prevent="submit" class="space-y-4">
                        <div>
                            <textarea
                                v-model="form.content"
                                placeholder="메모 내용을 입력하세요..."
                                class="min-h-[200px] w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                :class="{ 'border-red-500': form.errors.content }"
                            />
                            <p v-if="form.errors.content" class="mt-1 text-sm text-red-600">
                                {{ form.errors.content }}
                            </p>
                        </div>

                        <div class="flex justify-end gap-2">
                            <Link href="/dashboard" as="button" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                취소
                            </Link>
                            <Button type="submit" :disabled="form.processing">
                                {{ form.processing ? '수정 중...' : '수정' }}
                            </Button>
                        </div>
                    </form>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
