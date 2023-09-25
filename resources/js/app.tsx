import "./bootstrap";
// import "../css/app.css";

import { createInertiaApp } from "@inertiajs/react";
import { InertiaProgress } from "@inertiajs/progress";
import { createRoot } from "react-dom/client";

const appName =
  window.document.getElementsByTagName("title")[0]?.innerText || "Application";

createInertiaApp({
  title: title => `${title} - ${appName}`,
  resolve: name => {
    const pages = import.meta.glob("./Pages/**/*.tsx", { eager: true });
    return pages[`./Pages/${name}.tsx`];
  },
  setup({ el, App, props }) {
    createRoot(el).render(<App {...props} />);
  }
});

InertiaProgress.init({
  // The delay after which the progress bar will
  // appear during navigation, in milliseconds.
  delay: 250,

  // The color of the progress bar.
  color: "#4B5563",

  // Whether to include the default NProgress styles.
  includeCSS: true,

  // Whether the NProgress spinner will be shown.
  showSpinner: false
});
