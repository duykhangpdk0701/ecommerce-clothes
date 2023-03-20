import React, { FC } from "react";
// @mui
import Box from "@mui/material/Box";
import Stack from "@mui/material/Stack";
import Link from "@mui/material/Link";
import Card from "@mui/material/Card";
import Button from "@mui/material/Button";
import Divider from "@mui/material/Divider";
import Typography from "@mui/material/Typography";
import CardHeader from "@mui/material/CardHeader";
// utils
import { fToNow } from "@/utils/formatTime";
// components
import Iconify from "@/components/shared/iconify";
import Scrollbar from "@/components/shared/scrollbar";

// ----------------------------------------------------------------------

interface IAppNewsUpdate {
  title?: string;
  subheader?: string;
  list: {
    id: string;
    title: string;
    description: string;
    image: string;
    postedAt: Date;
  }[];
}

const AppNewsUpdate: FC<IAppNewsUpdate> = (props) => {
  const { title, subheader, list, ...other } = props;
  return (
    <Card {...other}>
      <CardHeader title={title} subheader={subheader} />

      <Scrollbar>
        <Stack spacing={3} sx={{ p: 3, pr: 0 }}>
          {list.map((news) => (
            <NewsItem key={news.id} news={news} />
          ))}
        </Stack>
      </Scrollbar>

      <Divider />

      <Box sx={{ p: 2, textAlign: "right" }}>
        <Button
          size="small"
          color="inherit"
          endIcon={<Iconify icon={"eva:arrow-ios-forward-fill"} />}
        >
          View all
        </Button>
      </Box>
    </Card>
  );
};

// ----------------------------------------------------------------------

interface INewsItem {
  news: {
    id: string;
    title: string;
    description: string;
    image: string;
    postedAt: Date;
  };
}

const NewsItem: FC<INewsItem> = ({ news }) => {
  const { image, title, description, postedAt } = news;

  return (
    <Stack direction="row" alignItems="center" spacing={2}>
      <Box
        component="img"
        alt={"avatar"}
        src={image}
        sx={{ width: 48, height: 48, borderRadius: 1.5, flexShrink: 0 }}
      />

      <Box sx={{ minWidth: 240, flexGrow: 1 }}>
        <Link color="inherit" variant="subtitle2" underline="hover" noWrap>
          {title}
        </Link>

        <Typography variant="body2" sx={{ color: "text.secondary" }} noWrap>
          {description}
        </Typography>
      </Box>

      <Typography
        variant="caption"
        sx={{ pr: 3, flexShrink: 0, color: "text.secondary" }}
      >
        {fToNow(postedAt)}
      </Typography>
    </Stack>
  );
};

export default AppNewsUpdate;
