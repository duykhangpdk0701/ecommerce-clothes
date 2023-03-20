import PropTypes from "prop-types";
import Link from "next/link";
// @mui
import { Box, List, ListItemText } from "@mui/material";
//
import { StyledNavItem, StyledNavItemIcon } from "./styles";
import { INavConfig } from "@/layout/AdminLayout/nav/config";
import { FC } from "react";
import { useRouter } from "next/router";

// ----------------------------------------------------------------------

interface INavSection {
  data: INavConfig[];
}

const NavSection: FC<INavSection> = ({ data = [], ...other }) => {
  return (
    <Box {...other}>
      <List disablePadding sx={{ p: 1 }}>
        {data.map((item: any) => (
          <NavItem key={item.title} item={item} />
        ))}
      </List>
    </Box>
  );
};

// ----------------------------------------------------------------------

NavItem.propTypes = {
  item: PropTypes.object,
};

function NavItem({ item }: { item: any }) {
  const router = useRouter();
  const { title, path, icon, info } = item;

  return (
    // @ts-ignore
    <StyledNavItem
      component={Link}
      href={path}
      sx={
        router.pathname === path
          ? {
              color: "text.primary",
              bgcolor: "action.selected",
              fontWeight: "fontWeightBold",
            }
          : undefined
      }
    >
      <StyledNavItemIcon>{icon && icon}</StyledNavItemIcon>

      <ListItemText disableTypography primary={title} />

      {info && info}
    </StyledNavItem>
  );
}
export default NavSection;
