import { Apps, ViewList } from "@mui/icons-material";
import {
  FormLabel,
  MenuItem,
  Paper,
  Select,
  ToggleButton,
  ToggleButtonGroup,
} from "@mui/material";
import React from "react";
import { TEXT_COLOR_GRAY } from "@/styles/color";

const ListProductSortBar = () => {
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
          <Select
            defaultValue="relevance"
            size="small"
            className="min-w-[150px]"
          >
            <MenuItem className="text-sm" value="relevance">
              Relevance
            </MenuItem>
            <MenuItem className="text-sm" value="date">
              Date
            </MenuItem>
            <MenuItem className="text-sm" value="low-to-high">
              Price Low to High
            </MenuItem>
            <MenuItem className="text-sm" value="high-to-low">
              Price High to Low
            </MenuItem>
          </Select>
        </div>
        <div className="flex gap-2 items-center">
          <FormLabel className={`text-sm`} style={{ color: TEXT_COLOR_GRAY }}>
            View:
          </FormLabel>
          <ToggleButtonGroup>
            <ToggleButton value="grid" aria-label="grid">
              <Apps />
            </ToggleButton>
            <ToggleButton value="list" aria-label="list">
              <ViewList />
            </ToggleButton>
          </ToggleButtonGroup>
        </div>
      </div>
    </Paper>
  );
};

export default ListProductSortBar;
