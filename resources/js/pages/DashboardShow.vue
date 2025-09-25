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
        title: '메모 상세',
        href: `/dashboard/${props.memoId}`,
    },
];

const deleteMemo = () => {
    if (confirm('정말로 이 메모를 삭제하시겠습니까?')) {
        const form = useForm({});
        form.delete(`/dashboard/${props.memoId}`, {
            onSuccess: () => {
                window.location.href = '/dashboard';
            }
        });
    }
};
</script>

<template>
    <Head title="메모 상세" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <Card class="max-w-2xl mx-auto">
                <CardHeader>
                    <CardTitle>메모 상세</CardTitle>
                </CardHeader>
                <CardContent>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">메모 내용</label>
                            <div class="min-h-[200px] w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 whitespace-pre-wrap">
                                {{ memo.content }}
                            </div>
                        </div>

                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <div>
                                <span>작성일: {{ memo.created_at }}</span>
                            </div>
                            <div>
                                <span>종류: {{ memo.kind === '1' ? '일반' : '중요' }}</span>
                            </div>
                        </div>

                        <div v-if="($page.props.auth?.user as any)?.role === 9" class="flex justify-end gap-2">
                            <Link :href="`/dashboard/edit/${memoId}`" as="button" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                수정
                            </Link>
                            <Button variant="destructive" @click="deleteMemo">
                                삭제
                            </Button>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
