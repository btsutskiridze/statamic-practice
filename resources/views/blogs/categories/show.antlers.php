{{ category_title = title }}
<div class="py-5">
    {{ parent:content }}
</div>
{{# -- start category dropdown-- #}}
{{ partial:dropdown/container header="{category_title}" }}
    {{ partial:dropdown/item Title="All" Url="{parent:url}" }}
    {{ taxonomy:categories collection="blogs" }}
        {{ if category_title != title }}
            {{ partial:dropdown/item Title="{title}" Url="{url}" }}
        {{ /if }}
    {{ /taxonomy:categories }}
{{ /partial:dropdown/container }}
{{# -- end category dropdown-- #}}
{{ entries paginate="2" as="posts" }}
    <div class="border border-green-400 mt-12">
        {{ posts }}
            <a
                href="{{ url }}"
                class="flex items-center justify-between p-5 border-t border-green-400 text-green-400 hover:text-green-900 hover:bg-green-400"
            >
                <span>{{ title }}</span>
                <span class="text-orange-400 font-extralight text-sm">
                    {{ date }}
                </span>
            </a>
        {{ /posts }}
    </div>
    {{ paginate }}
        <div class="flex flex-row p-4 gap-5">
            {{ links:all }}
                <a
                    href="{{ url }}"
                    class="text-white text-2xl hover:bg-gray-600 p-1 leading-none rounded-lg {{if page == current_page }}pointer-events-none cursor-default bg-gray-800{{endif}}"
                >
                    {{ page }}
                </a>
            {{ /links:all }}
        </div>
    {{ /paginate }}
{{ /entries }}
