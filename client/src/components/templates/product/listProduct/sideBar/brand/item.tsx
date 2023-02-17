import { TEXT_COLOR_BLACK } from "@/styles/color";
import Checkbox from "@mui/material/Checkbox";
import FormControlLabel from "@mui/material/FormControlLabel";
import React, { FC } from "react";
import ListItem from "@mui/material/ListItem";
import ListItemText from "@mui/material/ListItemText";

interface IListProductdSideBarBrandItem {
  name: string;
}

const ListProductdSideBarBrandItem: FC<IListProductdSideBarBrandItem> = (
  props
) => {
  const { name } = props;
  return (
    <ListItem disablePadding className="py-1.5">
      <ListItemText>
        <span className="text-sm text-color-gray">{name}</span>
      </ListItemText>
    </ListItem>
  );
};

export default ListProductdSideBarBrandItem;
