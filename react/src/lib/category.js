
export function getCategory(categories, id) {
    if (!categories || categories == [] || !id) return;
    for (let category of categories) {
        if (category.id == id) return category;
    }
}