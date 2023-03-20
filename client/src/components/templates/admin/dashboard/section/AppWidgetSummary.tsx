import React, { FC } from "react";
// @mui
import { alpha, styled } from "@mui/material/styles";
import Card from "@mui/material/Card";
import Typography from "@mui/material/Typography";
// utils
import { fShortenNumber } from "@/utils/formatNumber";
// components
import Iconify from "@/components/shared/iconify/Iconify";

// ----------------------------------------------------------------------

const StyledIcon = styled("div")(({ theme }) => ({
  margin: "auto",
  display: "flex",
  borderRadius: "50%",
  alignItems: "center",
  width: theme.spacing(8),
  height: theme.spacing(8),
  justifyContent: "center",
  marginBottom: theme.spacing(3),
}));

// ----------------------------------------------------------------------

interface IAppWidgetSummary {
  title: string;
  color?: string;
  icon?: string;
  total: number;
  sx?: Object;
}

const AppWidgetSummary: FC<IAppWidgetSummary> = ({
  title,
  total,
  icon,
  color = "primary",
  sx,
  ...other
}) => {
  return (
    <Card
      sx={{
        py: 5,
        boxShadow: 0,
        textAlign: "center",
        color: (theme: any) => theme.palette[color].darker,
        bgcolor: (theme: any) => theme.palette[color].lighter,
        ...sx,
      }}
      {...other}
    >
      <StyledIcon
        sx={{
          color: (theme: any) => theme.palette[color].dark,
          backgroundImage: (theme: any) =>
            `linear-gradient(135deg, ${alpha(
              theme.palette[color].dark,
              0
            )} 0%, ${alpha(theme.palette[color].dark, 0.24)} 100%)`,
        }}
      >
        <Iconify icon={icon} width={24} height={24} />
      </StyledIcon>

      <Typography variant="h3">{fShortenNumber(total)}</Typography>

      <Typography variant="subtitle2" sx={{ opacity: 0.72 }}>
        {title}
      </Typography>
    </Card>
  );
};

export default AppWidgetSummary;
