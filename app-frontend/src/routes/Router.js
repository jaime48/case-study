import { lazy } from "react";
import { Navigate } from "react-router-dom";

/****Layouts*****/
const FullLayout = lazy(() => import("../layouts/FullLayout.js"));

/***** Pages ****/

const News = lazy(() => import("../views/ui/News"));
const Login = lazy(() => import("../views/ui/Login"));
const Register = lazy(() => import("../views/ui/Register"));
const Setting = lazy(() => import("../views/ui/Setting"));

/*****Routes******/

const ThemeRoutes = [
  {
    path: "/",
    element: <FullLayout />,
    children: [
      { path: "/", element: <Navigate to="/news" /> },
      { path: "/news", exact: true, element: <News /> },
      { path: "/login", exact: true, element: <Login /> },
      { path: "/register", exact: true, element: <Register /> },
      { path: "/setting", exact: true, element: <Setting /> },
    ],
  },
];

export default ThemeRoutes;
