import { forwardRef } from "react";
// icons
import { Icon } from "@iconify/react";
// @mui
import { Box } from "@mui/material";

// ----------------------------------------------------------------------

const Iconify = forwardRef<HTMLElement, any>(
  ({ icon, width = 20, sx, ...other }, ref) => {
    return (
      <Box
        ref={ref}
        component={Icon}
        icon={icon}
        sx={{ width, height: width, ...sx }}
        {...other}
      />
    );
  }
);

export default Iconify;
