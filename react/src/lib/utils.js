
let debs = new Map();
export default function debounce(func, delay = 1000, constdata) {
    let timer = debs.get(constdata);
    if (timer) {
        clearTimeout(timer);
        // debs.set(constdata, undefined);
    };
    debs.set(constdata, setTimeout(() => { func(); }, delay));
  }