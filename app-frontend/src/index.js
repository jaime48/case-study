import React, { Suspense } from "react";
import {createRoot} from 'react-dom/client';
import "./assets/scss/style.scss";
import App from "./App";
import reportWebVitals from "./reportWebVitals";
import { HashRouter } from "react-router-dom";

const rootElement = document.getElementById('root');
const root = createRoot(rootElement);

root.render(
  <Suspense>
    <HashRouter>
      <App />
    </HashRouter>
  </Suspense>,
);

reportWebVitals();
