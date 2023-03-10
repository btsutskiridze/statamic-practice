<script setup>
import { onMounted, ref } from "vue";
import { useStatamicApi } from "../composables/Statmic/useStatamic";

const allBlogs = ref([]);
const categories = ref([]);
const filteredBlogs = ref([]);
const selectedCategories = ref([]);

const { fetchCollection } = useStatamicApi();

const getBlogs = async (filterValue) => {
    fetchCollection("blogs").then(({ data, meta }) => {
        allBlogs.value = data;
    });
};

const getFilteredBlogs = async (category) => {
    try {
        const res = await fetch(
            `/api/collections/blogs/entries?filter[categories:is]=${category.slug}`
        );
        const { data, meta } = await res.json();
        filteredBlogs.value.push(...data);
        console.log(filteredBlogs.value);
    } catch (e) {
        console.log(e);
    } finally {
    }
};

const getCategories = async () => {
    try {
        const res = await fetch(`/api/taxonomies/categories/terms`);
        const { data, meta } = await res.json();
        categories.value = data;
    } catch (e) {
        console.log(e);
    } finally {
    }
};

const toggleCategorySelection = (category) => {
    const categorySlug = category.slug;

    if (!selectedCategories.includes(categorySlug)) {
        selectedCategories.value = {
            ...selectedCategories.value,
            categorySlug,
        };
    }

    return selectedCategories.filter((category) => category !== categorySlug);
};

onMounted(() => {
    getBlogs();
    getCategories();
});
</script>

<template>
    <div class="flex justify-around">
        <button
            class="text-[#fe3b1f] py-1 px-2 rounded-xl hover:text-[#fff] hover:bg-[#fe3b1f]"
            :class="category.isSelected ? 'text-[#fff] bg-[#fe3b1f]' : ''"
            v-for="category in categories"
            :id="category.id"
            @click="toggleCategorySelection"
        >
            {{ category.title }}
        </button>
    </div>

    <div v-cloak class="border border-orange-700 mt-12">
        <a
            v-for="blog in filteredBlogs.length ? filteredBlogs : allBlogs"
            :href="blog.url"
            class="flex items-center justify-between p-5 border-t border-orange-700 text-[#fe3b1f] hover:text-[#fff] hover:bg-[#fe3b1f]"
        >
            <span>{{ blog.title }}</span>
            <span class="font-medium text-sm">
                {{ blog.date }} - {{ blog.categories?.title }}
            </span>
        </a>
    </div>
    <pagination
        start-page="1"
        count="items.total_count"
        change="sendNewPageRequest"
    />
</template>
