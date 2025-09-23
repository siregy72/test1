<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table/index';
import { Button } from '@/components/ui/button';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="flex justify-end">
                <Button variant="outline" size="sm" class="w-10">등록</Button>
            </div>
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>제목</TableHead>
                        <TableHead>작성자</TableHead>
                        <TableHead>날짜</TableHead>
                        <TableHead>수정/삭제</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow>
                        <TableCell>메모 1</TableCell>
                        <TableCell>사용자</TableCell>
                        <TableCell>2025-09-23</TableCell>
                        <TableCell class="flex justify-end gap-2">
                            <Button>수정</Button>
                            <Button variant="destructive">삭제</Button>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
