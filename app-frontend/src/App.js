import React, { useState } from 'react';
import { useRoutes } from "react-router-dom";
import Themeroutes from "./routes/Router";

const App = () => {
  const [headerForceUpdate, setHeaderForceUpdate] = useState(false);
  const reloadHeader = () => {
    setHeaderForceUpdate(!headerForceUpdate);
  };

  const routing = useRoutes(Themeroutes);

  return <div className="dark">{routing}</div>;
};

export default App;
