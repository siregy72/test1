<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];

const props = defineProps({
    memos1:{
        type: Array,
    },
    memos9:{
        type: Array,
    }
});

const editMemo = (memoId: number) => {
    // 수정 페이지로 이동
    window.location.href = `/dashboard/edit/${memoId}`;
};

const deleteMemo = (memoId: number) => {
    if (confirm('정말로 이 메모를 삭제하시겠습니까?')) {
        const form = useForm({});
        form.delete(`/dashboard/${memoId}`, {
            onSuccess: () => {
                // 삭제 성공 시 페이지 새로고침
                window.location.reload();
            }
        });
    }
};
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div v-if="($page.props.auth?.user as any)?.role === 9" class="flex justify-end">
                <Button variant="outline">
                    <Link href="/dashboard/create/1">등록</Link>
                </Button>
            </div>
            <Card v-for="memo in memos1" :key="memo.id">
                <CardContent>
                    <div class="whitespace-pre-wrap">{{ memo.content }}</div>
                    <div v-if="($page.props.auth?.user as any)?.role === 9" class="flex justify-end gap-2">
                                <Button @click="editMemo(memo.id)">수정</Button>
                                <Button variant="destructive" @click="deleteMemo(memo.id)">삭제</Button>
                            </div>
                </CardContent>
            </Card>
            <div v-if="($page.props.auth?.user as any)?.role === 9" class="flex justify-end">
                <Button variant="outline">
                    <Link href="/dashboard/create/9">등록</Link>
                </Button>
            </div>
            <Card v-if="($page.props.auth?.user as any)?.role === 9" v-for="memo in memos9" :key="memo.id">
                <CardContent>
                    <div class="whitespace-pre-wrap">{{ memo.content }}</div>
                    <div v-if="($page.props.auth?.user as any)?.role === 9" class="flex justify-end gap-2">
                                <Button @click="editMemo(memo.id)">수정</Button>
                                <Button variant="destructive" @click="deleteMemo(memo.id)">삭제</Button>
                            </div>
                </CardContent>
            </Card>
        </div>
    </AppLayout>
</template>
