import { TEXT_COLOR_BLACK } from "@/styles/color";
import Checkbox from "@mui/material/Checkbox";
import FormControlLabel from "@mui/material/FormControlLabel";
import React, { FC } from "react";

interface IListProductdSideBarColorItem {
  name: string;
}

const ListProductdSideBarColorItem: FC<IListProductdSideBarColorItem> = (
  props
) => {
  const { name } = props;
  return (
    <FormControlLabel
      control={<Checkbox size="small" />}
      label={<span className="text-sm text-color-black">{name}</span>}
    />
  );
};

export default ListProductdSideBarColorItem;
