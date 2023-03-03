import React from "react";
import { TEXT_COLOR_GRAY } from "@/styles/color";
// mui component
import FormLabel from "@mui/material/FormLabel";
import MenuItem from "@mui/material/MenuItem";
import Paper from "@mui/material/Paper";
import Select from "@mui/material/Select";
import ToggleButton from "@mui/material/ToggleButton";
import ToggleButtonGroup from "@mui/material/ToggleButtonGroup";
// mui icon
import AppsIcon from "@mui/icons-material/Apps";
import ViewListIcon from "@mui/icons-material/ViewList";
import { useAppDispatch, useAppSelector } from "@/hooks/redux";
import { setListAciton } from "@/contexts/slices/listProductSlice";
import { useFormContext, Controller } from "react-hook-form";

const ListProductSortBar = () => {
  const listProductState = useAppSelector((state) => state.ListProduct);
  const dispatch = useAppDispatch();
  const { control } = useFormContext();

  const handleAlignment = (
    event: React.MouseEvent<HTMLElement>,
    newAlignment: "grid" | "list"
  ) => {
    dispatch(setListAciton(newAlignment));
  };

  return (
    <Paper className="flex justify-between py-2 px-5 mb-14 items-center">
      <div>
        <h5 className="text-base font-semibold">
          Searching for “ mobile phone ”
        </h5>
        <p className={`text-sm`} style={{ color: TEXT_COLOR_GRAY }}>
          48 results found
        </p>
      </div>
      <div className="flex gap-8 my-2">
        <div className="flex gap-2 items-center">
          <FormLabel className={`text-sm`} style={{ color: TEXT_COLOR_GRAY }}>
            Sort by:
          </FormLabel>
          <Controller
            defaultValue=""
            name="sortBy"
            control={control}
            render={({ field }) => (
              <Select
                value={field.value}
                onChange={field.onChange}
                size="small"
                className="min-w-[150px]"
              >
                <MenuItem className="text-sm" value={1}>
                  Relevance
                </MenuItem>
                <MenuItem className="text-sm" value={2}>
                  Date
                </MenuItem>
                <MenuItem className="text-sm" value={8}>
                  Price Low to High
                </MenuItem>
                <MenuItem className="text-sm" value={7}>
                  Price High to Low
                </MenuItem>
              </Select>
            )}
          />
        </div>
        <div className="flex gap-2 items-center">
          <FormLabel className={`text-sm`} style={{ color: TEXT_COLOR_GRAY }}>
            View:
          </FormLabel>
          <ToggleButtonGroup
            value={listProductState.listType}
            onChange={handleAlignment}
            exclusive
          >
            <ToggleButton value="grid" aria-label="grid">
              <AppsIcon />
            </ToggleButton>
            <ToggleButton value="list" aria-label="list">
              <ViewListIcon />
            </ToggleButton>
          </ToggleButtonGroup>
        </div>
      </div>
    </Paper>
  );
};

export default ListProductSortBar;
