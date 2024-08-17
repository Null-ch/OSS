import { BRAND } from "../utils/constants";

export function updateTabTitle(title) {
    document.title = title ? `${BRAND} ${title}` : BRAND;
}