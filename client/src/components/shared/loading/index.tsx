import Box from "@mui/material/Box";
import CircularProgress from "@mui/material/CircularProgress";
import React from "react";

const Loading = () => {
  return (
    <Box className="absolute z-20 top-0 left-0 w-full h-full flex items-center justify-center">
      <Box className=" absolute left-0 top-0 w-full h-full backdrop-blur-[2px] bg-white/10"></Box>
      <CircularProgress />
    </Box>
  );
};

export default Loading;
