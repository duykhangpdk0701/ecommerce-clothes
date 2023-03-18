// @mui
import { styled, alpha } from "@mui/material/styles";
import Toolbar from "@mui/material/Toolbar";
import Typography from "@mui/material/Typography";
import OutlinedInput from "@mui/material/OutlinedInput";
import InputAdornment from "@mui/material/InputAdornment";
// component
import Iconify from "@/components/shared/iconify";
import { FC } from "react";
import { Control, Controller } from "react-hook-form";

// ----------------------------------------------------------------------

const StyledRoot = styled(Toolbar)(({ theme }) => ({
  height: 96,
  display: "flex",
  justifyContent: "space-between",
  padding: theme.spacing(0, 1, 0, 3),
}));

const StyledSearch = styled(OutlinedInput)(({ theme }) => {
  const customTheme = theme as any;
  return {
    width: 240,
    transition: theme.transitions.create(["box-shadow", "width"], {
      easing: theme.transitions.easing.easeInOut,
      duration: theme.transitions.duration.shorter,
    }),
    "&.Mui-focused": {
      width: 320,
      boxShadow: customTheme.customShadows.z8,
    },
    "& fieldset": {
      borderWidth: `1px !important`,
      borderColor: `${alpha(theme.palette.grey[500], 0.32)} !important`,
    },
  };
});

// ----------------------------------------------------------------------

interface IListBrandToolbar {
  numSelected: number;

  control: Control<any, any>;
}

const ListBrandToolbar: FC<IListBrandToolbar> = (props) => {
  const { numSelected, control } = props;

  return (
    <StyledRoot
      sx={{
        ...(numSelected > 0 && {
          color: "primary.main",
          bgcolor: "primary.lighter",
        }),
      }}
    >
      {numSelected > 0 ? (
        <Typography component="div" variant="subtitle1">
          {numSelected} selected
        </Typography>
      ) : (
        <Controller
          name="search"
          control={control}
          render={({ field }) => (
            <StyledSearch
              {...field}
              placeholder="Search user..."
              startAdornment={
                <InputAdornment position="start">
                  <Iconify
                    icon="eva:search-fill"
                    sx={{ color: "text.disabled", width: 20, height: 20 }}
                  />
                </InputAdornment>
              }
            />
          )}
        />
      )}
    </StyledRoot>
  );
};

export default ListBrandToolbar;
